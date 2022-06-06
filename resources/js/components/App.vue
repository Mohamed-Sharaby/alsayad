<template>
    <div id="bill-section">
        <div class="sections">
            <ul class="tabs">
                <li
                    @click.prevent="setActive('all', 'all')"
                    :class="{ active: isActive('all') }"
                >
                    الكل
                </li>
                <li
                    v-for="category in categories"
                    :key="category.id"
                    @click.prevent="setActive(category.name, category.id)"
                    :class="{ active: isActive(category.name) }"
                >
                    {{ category.name }}
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab">
                    <div
                        class="product modal-opener"
                        @click="
              setActiveMenu(`${product.id}`);
              addProduct(product, { name: 'بدون', id: null }, $event);
            "
                        v-for="product in products"
                        :key="product.id"
                        v-click-outside-app="done"
                    >
                        <img :src="product.image" alt="product img" class="inner"/>
                        <h3 class="inner">{{ product.name }}</h3>
                        <p class="inner">{{ product.price }} ريال</p>
                        <div
                            v-if="product.is_cooking == 1"
                            class="modal"
                            :class="{ active: isMenuActive(`${product.id}`) }"
                        >
                            <ul>
                                <li>
                                    <button
                                        class="addButton"
                                        @click="
                      addProduct(product, { name: 'بدون', id: null }, $event);
                      setActiveMenu(`none`);
                    "
                                    >
                                        بدون
                                    </button>
                                </li>
                                <li v-for="type in cookingTypes" :key="type.id">
                                    <button
                                        class="addButton"
                                        @click="
                      addProduct(product, type, $event);
                      setActiveMenu(`none`);
                    "
                                    >
                                        {{ type.name }}
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div v-if="!products[0]">لا يوجد أصناف في هذا القسم</div>
                </div>
            </div>
        </div>
        <div class="bill">
            <form @submit.prevent="saveInvoice">
                <table class="bill-products">
                    <tr>
                        <th>اسم الصنف</th>
                        <th>السعر</th>
                        <th>الكمية</th>
                        <th>نوع الطبخ</th>
                        <th>سعر الطبخ</th>
                        <th>العمليات</th>
                    </tr>
                    <tr
                        v-for="product in productsInBill"
                        :key="product.product_id + product.cooking_id"
                    >
                        <td>{{ product.product_name }}</td>
                        <td>
                            <input
                                type="number"
                                step="0.0001"
                                name="price"
                                v-model="product.product_price"
                                @change="handlePoints"
                                min="1"
                            />
                        </td>
                        <td>
                            <input
                                type="number"
                                name="qty"
                                v-model="product.quantity"
                                @change="handlePoints"
                                min="1"
                            />
                        </td>
                        <td>{{ product.cooking_name }}</td>
                        <td>
                            {{ product.cooking_name == "بدون" ? 0 : "" }}
                            <input
                                v-if="product.cooking_name != 'بدون'"
                                type="number"
                                step="0.0001"
                                name="cooking_price"
                                v-model="product.cooking_price"
                                @change="handlePoints"
                                min="1"
                            />
                        </td>
                        <td>
                            <button type="button" @click="removeItem(product)">حذف</button>
                        </td>
                    </tr>
                    <tr v-if="!productsInBill[0]">
                        <h4>لا يوجد أصناف مضافة</h4>
                    </tr>
                </table>
                <table class="info">
                    <tr>
                        <td>اجمالي المنتجات</td>
                        <td>{{ getTotalWithoutTax }} ريال</td>
                    </tr>
                    <tr>
                        <td>الضريبة {{ tax }}%</td>
                        <td>{{ geTaxAmount }} ريال</td>
                    </tr>
                    <tr>
                        <td>الاجمالي</td>
                        <td>{{getTotal}} ريال</td>
                    </tr>
                    <tr>
                        <td><label for="client">اسم العميل</label></td>
                        <td>
                            <div
                                style="
                  min-width: 220px;
                  margin-left: 15px;
                  display: inline-block;
                "
                            >
                                <v-select
                                    v-model="selectedClient"
                                    label="name"
                                    :options="clients"
                                />
                            </div>

                            <!-- <select
                              v-model="selectedClient"
                              name="client"
                              id="client"
                              required
                            >
                              <option :value="{ name: 'نقدي', id: null, points: 0 }">
                                عميل نقدي
                              </option>
                              <option
                                v-for="client in clients"
                                :key="client.id"
                                :value="client"
                              >
                                {{ client.name }}
                              </option>
                            </select> -->
                            <button
                                @click="AddClientModal = true"
                                type="button"
                                class="modal-opener"
                            >
                                إضافة عميل
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>رصيد العميل من النقاط</td>
                        <td>{{ selectedClient ? selectedClient.points : 0 }}</td>
                    </tr>
                    <tr>
                        <td>النقاط</td>
                        <td>
                            <input
                                type="checkbox"
                                name=""
                                id="use-points"
                                v-model="usePoints"
                                @change="handlePoints"
                                :disabled="!selectedClient.id || selectedClient.points == '0'"
                            />
                            <label for="use-points">استخدام النقاط</label>
                        </td>
                    </tr>
                    <tr>
                        <td>حالة الفاتورة</td>
                        <td>
                            <input
                                required
                                @change="billStateChanged($event)"
                                type="radio"
                                name="bill-status"
                                id="paid"
                                value="paid"
                            />
                            <label for="paid">مسددة كليا</label>
                            <input
                                @change="billStateChanged($event)"
                                :disabled="selectedClient.name == 'نقدي'"
                                type="radio"
                                name="bill-status"
                                id="partially"
                                value="partially"
                            />
                            <label for="partially">مسددة جزئيا</label>
                            <input
                                @change="billStateChanged($event)"
                                :disabled="selectedClient.name == 'نقدي'"
                                type="radio"
                                name="bill-status"
                                id="unpaid"
                                value="unpaid"
                            />
                            <label for="unpaid">غير مسددة</label>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top">
                            <label style="margin-left: 130px">المدفوع بالنقاط</label>
                        </td>
                        <td>
                            {{ discounted_from_points }}
                        </td>
                    </tr>
                    <tr v-if="usePoints && billStatus == 'paid'">
                        <td style="vertical-align: top">
                            <label style="margin-left: 130px">المطلوب كاش</label>
                        </td>
                        <td>
                            {{ getTotal - discounted_from_points }}
                        </td>
                    </tr>
                    <tr v-if="billStatus == 'partially'">
                        <td>
                            المدفوع
                            <input
                                required
                                type="number"
                                name="paid"
                                v-model="paid"
                                min="1"
                                :max="getTotal"
                            />
                        </td>
                        <td>
                            المتبقي
                            {{
                                getTotal - paid - discounted_from_points
                            }}
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top">
                            <label style="margin-left: 130px">ملاحظات</label>
                        </td>
                        <td>
              <textarea
                  name="notes"
                  id=""
                  cols="65"
                  rows="5"
                  v-model="notes"
              ></textarea>
                        </td>
                    </tr>
                </table>
                <input type="submit" value="حفظ"/>
            </form>
        </div>
        <div style="width: 100%">
            <div class="toPrint hide" v-for="i in 3" :key="i">
                <div v-html="settings.invoice_top"></div>
                <div class="upper-info">
                    <p>فاتورة رقم {{ billCode }}</p>
                    <div class="details">
                        <p>اسم العميل</p>
                        <p>{{ selectedClient.name }}</p>
                    </div>
                    <div class="details">
                        <p>حالة الدفع</p>
                        <p>
                            {{
                                billStatus == "paid"
                                    ? "مسددة كليا"
                                    : billStatus == "unpaid"
                                        ? "غير مسددة"
                                        : "مسددة جزئيا"
                            }}
                        </p>
                    </div>
                    <div class="details">
                        <p>تاريخ الفاتورة</p>
                        <p>{{ getDate }}</p>
                    </div>
                    <!-- <div class="details">
                    <p>البائع</p>
                    <p>.....</p>
                  </div> -->
                </div>
                <hr/>
                <table>
                    <tr>
                        <th>م</th>
                        <th>الصنف</th>
                        <th>السعر</th>
                        <th>الكمية</th>
                        <th>الطبخ</th>
                        <th>سعر الطبخ</th>
                        <th>الاجمالي</th>
                    </tr>
                    <tr
                        v-for="(product, i) in productsInBill"
                        :key="product.product_id + product.cooking_id"
                    >
                        <td>{{ i + 1 }}</td>
                        <td>{{ product.product_name }}</td>

                        <td>{{ product.product_price }}</td>
                        <td>{{ product.quantity }}</td>
                        <td>{{ product.cooking_name }}</td>
                        <td>
                            {{ product.cooking_name == "بدون" ? 0 : product.cooking_price }}
                        </td>
                        <td>
                            {{
                                product.product_price * product.quantity +
                                parseFloat(product.cooking_price)
                            }}
                        </td>
                    </tr>
                </table>
                <hr/>
                <div class="bill-summary">
                    <div class="details">
                        <p>الاجمالي</p>
                        <p>{{ getTotalWithoutTax }}</p>
                    </div>
                    <div class="details">
                        <p>ضريبة القيمة المضافة {{ tax }}%</p>
                        <p>{{ geTaxAmount}}</p>
                    </div>
                    <div class="details">
                        <p>اجمالي الفاتورة</p>
                        <p>{{ getTotal }}</p>
                    </div>
                    <div class="details">
                        <p>المدفوع نقدي</p>
                        <p>{{ paid }}</p>
                    </div>
                    <div class="details">
                        <p>المدفوع من النقاط</p>
                        <p>{{ discounted_from_points }}</p>
                    </div>
                    <div class="details">
                        <p>المتبقي</p>
                        <p>
                            {{
                                getTotal - paid - discounted_from_points
                            }}
                        </p>
                    </div>
                </div>

                <div v-html="settings.invoice_bottom" class=""></div>
                <qrcode-vue :value="uuid" :size="100" level="H" style="text-align: center; padding: 10px"/>
                <p class="copyright">Powered by Panorama Al-Qassim</p>
            </div>
        </div>

        <div v-if="AddClientModal">
            <transition name="model">
                <div class="modal-mask">
                    <div class="modal-wrapper">
                        <div v-click-outside-app="close" class="modal">
                            <form class="modal-form" action="" @submit.prevent="addClient">
                                <input v-model="clientToAdd.name" type="text" name="" placeholder="اسم العميل"
                                       required
                                />
                                <input v-model="clientToAdd.phone" type="tel" name="" placeholder="رقم الجوال"
                                       required
                                />
                                <input v-model="clientToAdd.address" type="text" name="" placeholder="العنوان"
                                       required
                                />
                                <textarea name="" placeholder="ملاحظات" cols="30" rows="10"></textarea>
                                <input type="submit" value="اضافة عميل"/>
                            </form>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
        <div v-if="showError">
            <transition name="model">
                <div class="modal-mask">
                    <div class="modal-wrapper">
                        <div v-click-outside-app="close" class="modal">
                            {{ error }}
                        </div>
                    </div>
                </div>
            </transition>
        </div>
        <Loader
            v-if=" loader "
        >\
        </Loader
        >
    </div>
</template>

<script>
import Loader from "./Loader.vue";
import QrcodeVue from 'qrcode.vue'

export default {
    name: "App",
    data() {
        return {
            loader: true,
            uuid: '',
            activeItem: "all",
            activeMenu: null,
            categories: null,
            products: [],
            cookingTypes: [],
            productsInBill: [],
            total: 0,
            tax: null,
            paid: 0,
            billStatus: null,
            notes: "",
            modalappearance: false,
            clients: [],
            selectedClient: {name: "نقدي", id: null, points: 0},
            AddClientModal: false,
            clientToAdd: {
                name: "",
                phone: "",
                address: "",
                notes: "",
            },
            usePoints: false,
            showError: false,
            error: "",
            billCode: null,
            discounted_from_points: 0,
            settings: {points: 0},
        };
    },
    components: {
        Loader,
        QrcodeVue,
    },
    computed: {
        getTotal() {
            var total = 0;
            for (let i in this.productsInBill) {
                total +=
                    this.productsInBill[i].product_price *
                    this.productsInBill[i].quantity +
                    +this.productsInBill[i].cooking_price;
            }
            return total.toFixed(2);
        },
        getTotalWithoutTax() {
         return  (this.getTotal *((100-this.tax)/100)).toFixed(2)
        },

        geTaxAmount() {
         return (this.getTotal *(this.tax/100)).toFixed(2)
          },

        getDate() {
            var today = new Date();
            var date =
                today.getFullYear() +
                "-" +
                (today.getMonth() + 1) +
                "-" +
                today.getDate();
            return date;
        },
        pointsCoverage() {
            if (this.selectedClient) {
                if (
                    this.selectedClient.points * +this.settings.points >
                    (this.getTotal * (100 + +this.tax)) / 100
                ) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        },
    },
    mounted() {
     (async ()=>{
        axios
            .get(`/api/categories`)
            .then((response) => {
                this.categories = response.data;
                this.getProducts("all");
            })
            .catch((error) => {
                this.error = error;
                this.showError = true;
            });
        axios
            .get(`/api/cooking-types`)
            .then((response) => {
                this.cookingTypes = response.data;
            })
            .catch((error) => {
                console.warn = () => {
                };
                this.error = error;
                this.showError = true;
            });
        axios
            .get(`/api/settings`)
            .then((response) => {
                this.tax = response.data.tax;
                this.settings = response.data;
            })
            .catch((error) => {
                console.warn = () => {
                };
                this.error = error;
                this.showError = true;
            });
        axios
            .get(`/api/clients`)
            .then((response) => {
                this.clients = response.data;
            })
            .catch((error) => {
                console.warn = () => {
                };
                this.error = error;
                this.showError = true;
            });
     })().then(()=>{this.loader=false;})

        },
    methods: {
        done() {
            this.setActiveMenu("none");
        },
        isActive(menuItem) {
            return this.activeItem === menuItem;
        },
        setActive(menuItem, id) {
            this.activeItem = menuItem;
            this.getProducts(id);
        },
        getProducts(id) {
            this.loader = true;
            this.products = [];
            axios
                .get(
                    `/api/products${id == "all" ? "" : "?category_id=" + id}`
                )
                .then((response) => {
                    this.products = response.data;
                    this.loader = false;
                });
        },
        isMenuActive(menuId) {
            return this.activeMenu === menuId;
        },
        setActiveMenu(menuId) {
            this.activeMenu = menuId;
        },

        addProduct(product, type, $event) {
            $event.stopPropagation();
            if (
                product.is_cooking == 0 ||
                (product.is_cooking == 1 &&
                    $event.target.classList.contains("addButton"))
            ) {
                let productToPush = {
                    product_name: product.name,
                    product_id: product.id,
                    product_price: product.price,
                    cooking_id: type.id,
                    cooking_name: type.name,
                };
                let inBill = false;

                for (let i in this.productsInBill) {
                    if (
                        this.productsInBill[i].product_id == productToPush.product_id &&
                        this.productsInBill[i].cooking_id == productToPush.cooking_id
                    ) {
                        inBill = true;
                        this.productsInBill[i].quantity =
                            +this.productsInBill[i].quantity + 1;
                    }
                }
                if (!inBill) {
                    productToPush.quantity = 1;
                    productToPush.cooking_price = 0;
                    this.productsInBill.push(productToPush);
                }
            }
            this.handlePoints();
        },

        close() {
            this.AddClientModal = false;
            this.showError = false;
            this.clientToAdd = {
                name: "",
                phone: "",
                address: "",
                notes: "",
            };
        },
        addClient() {
            axios
                .post(`/api/clients`, this.clientToAdd)
                .then((response) => {
                    if (response.status) {
                        this.clients.push({
                            id: response.data.id,
                            name: response.data.name,
                        });

                        this.AddClientModal = false;
                        this.clientToAdd = {
                            name: "",
                            phone: "",
                            address: "",
                            notes: "",
                        };
                    }
                });
        },
        removeItem(product) {
            this.productsInBill = this.productsInBill.filter(
                (item) => item !== product
            );
        },
        billStateChanged(event) {
            this.billStatus = event.target.value;
            if (event.target.value == "paid") {
                this.paid = (this.getTotal * (100 + +this.tax)) / 100;
            } else {
                this.paid = 0;
            }
        },
        handlePoints() {
            if (this.selectedClient.id) {
                let radios = document.querySelectorAll("input[type='radio'");
                let discount = this.selectedClient.points * +this.settings.points;
                if (discount > (this.getTotal * (100 + +this.tax)) / 100) {
                    if (this.usePoints) {
                        this.discounted_from_points =
                            (this.getTotal * (100 + +this.tax)) / 100;
                        this.paid = 0;
                        this.billStatus = "paid";
                        radios.forEach((element) => {
                            if (element.id == "paid") {
                                element.checked = true;
                            } else {
                                element.checked = false;
                            }
                            element.disabled = true;
                        });
                    } else {
                        this.discounted_from_points = 0;
                        radios.forEach((element) => {
                            element.disabled = false;
                        });
                    }
                } else {
                    if (this.usePoints) {
                        this.discounted_from_points = discount;
                        console.log("df");

                        radios.forEach((element) => {
                            if (element.value == "paid" || element.value == "partially") {
                                element.disabled = false;
                            } else {
                                element.disabled = true;
                            }
                        });
                    } else {
                        this.discounted_from_points = 0;
                        radios.forEach((element) => {
                            element.disabled = false;
                        });
                    }
                }
            }
        },
        saveInvoice() {
            if (!this.productsInBill[0]) {
                this.error = "لا يوجد أصناف مضافة في الفاتورة";
                this.showError = true;
            } else {
                if (this.billStatus == "paid") {
                    if (this.usePoints) {
                        this.paid =
                            this.getTotal  -
                            this.discounted_from_points;
                    } else {
                        this.paid = this.getTotal ;
                    }
                } else if (this.billStatus == "unpaid") {
                    this.paid = 0;
                }
                axios
                    .post(`/api/save-invoice`, {
                        products: this.productsInBill,
                        client_id: this.selectedClient.id,
                        total: this.getTotal,
                        status: this.billStatus,
                        received: this.paid,
                        is_points: this.usePoints ? 1 : 0,
                        notes: this.notes,
                    })
                    .then(async (response) => {
                        if (response.data.status) {
                            this.billCode = response.data.code;
                            this.uuid = response.data.uuid;
                            this.$nextTick(() => {
                                this.print();
                                setTimeout(()=>{
                                    this.productsInBill = [];
                                    this.selectedClient = {name: "نقدي", id: null, points: 0};
                                    this.usePoints = false;
                                    this.paid = 0;
                                    this.billCode = null;
                                    this.notes = "";
                                    this.discounted_from_points = 0;
                                    document
                                        .querySelectorAll("input[type='radio']")
                                        .forEach((element) => {
                                            element.checked = false;
                                        });
                                }, 100);
                            });

                            // reset all the data to receive new bill
                        } else {
                            this.error = response.data.msg;
                            this.showError = true;
                        }
                    })
                    .catch((error) => {
                        this.error = error;
                        this.showError = true;
                    });
            }
        },
        print() {
            // print the pill

            document.getElementsByClassName("sections")[0].classList.add("hide");
            document.getElementsByClassName("bill")[0].classList.add("hide");
            document.getElementsByClassName("toPrint")[0].classList.remove("hide");
            document.getElementsByClassName("toPrint")[1].classList.remove("hide");
            document.getElementsByClassName("toPrint")[2].classList.remove("hide");

            // document.getElementsByClassName("toPrint").forEach((element) => {
            //     element.classList.remove("hide");
            // });
            setTimeout(function(){ window.print();
                document.getElementsByClassName("sections")[0].classList.remove("hide");
                document.getElementsByClassName("bill")[0].classList.remove("hide");
                document.getElementsByClassName("toPrint")[0].classList.add("hide");
                document.getElementsByClassName("toPrint")[1].classList.add("hide");
                document.getElementsByClassName("toPrint")[2].classList.add("hide"); }, 50);


            // document.getElementsByClassName("toPrint").forEach((element) => {
            //     element.classList.add("hide");
            // });
        },
        // handleError(error) {
        //   console.log(error);
        //   this.error;
        // },
    },
};
</script>



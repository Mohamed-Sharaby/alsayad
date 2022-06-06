<div class="row">
    <div class="col-12 ">
        <form class="form-horizontal" method="get"
              action="{{route('admin.storage-invoices.index')}}">

            <div class="form-group row ">
                <div class="col-12 col-md-3">
                    <label class="  control-label">اسم المورد </label>
                    <select name="supplier_id" id="supplier_id" class="form-control select2">
                        <option selected disabled>اختر المورد  </option>
                        @foreach(suppliers() as $id => $name)
                            <option
                                value="{{$id}}" {{request('supplier_id') == $id ? 'selected': ''}}>{{$name}}</option>
                        @endforeach
                    </select>
                    @error('supplier_id')
                    <div class="invalid-feedback" style="color: #ef1010">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-12 col-md-3">
                    <label class="control-label" for="example-email">من تاريخ </label>
                    <input type="date" class="form-control"
                           placeholder="mm/dd/yyyy" name="from" value="{{request('from')}}">
                    @error('from')
                    <div class="invalid-feedback" style="color: #ef1010">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-12 col-md-3">
                    <label class="control-label" for="example-email"> الى تاريخ </label>
                    <input type="date" class="form-control"
                           placeholder="mm/dd/yyyy" name="to" value="{{request('to')}}">
                    @error('to')
                    <div class="invalid-feedback" style="color: #ef1010">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                 <div class="col-12 col-md-2">
                    <label class="control-label" > الغاء </label>
                     <a href="{{route('admin.storage-invoices.index')}}" class="form-control btn btn-purple"> الغاء الفلتر</a>
                </div>

            </div>

            <div class="form-group row text-center">
                <button type="submit"
                        class="btn btn-success btn-block col-12 waves-effect waves-light ">
                    بحث
                </button>
            </div>

        </form>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            新增公告
        </h1>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <form action = {{route('notice.store')}}
            method="POST" role="form" >
            @method('POST')
            @csrf
            <div class="form-group">
                <label for="title">
                    標題:
                </label>

                <input id="title"
                       name = "title"
                       class= "form control"
                       placeholder = "請輸入標題內容 "
                >
            </div>

            <div class="form-group">
                <label for="content">
                    公告內容:
                </label>

                <br>

                <textarea name="content"
                          id="content"
                          placeholder="請輸入內容"
                          rows="8"
                          cols="100"
                >
                </textarea>
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-success">新增</button>
            </div>
        </form>

    </div>
</div>

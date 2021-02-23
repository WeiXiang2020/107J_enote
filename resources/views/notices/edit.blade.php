
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            變更公告:<small>{{$course -> name}}</small>
        </h1>
    </div>
</div>



<div class="row">
    <div class="col-lg-12">
        <form action = {{route('notice.update',[$course -> id,$notice -> id])}}
              method="POST" role="form" >
            @method('PATCH')
            @csrf
            <div class="form-group">
                <label for="title">
                    標題:
                </label>

                <input id="title"
                       name = "notice_title"
                       class= "form control"
                       value="{{$notice -> title}}"
                >
            </div>

            <div class="form-group">
                <label for="content">
                    公告內容:
                </label>

                <br>

                <textarea name="notice_content"
                          id="content"

                          rows="8"
                          cols="100"
                >
                    {{$notice -> content}}
                </textarea>
            </div>

            <div class="text-right">
                <button type="submit"
                        class="btn btn-success"
                        name="sub"
                        value="finish"
                >完成</button>
            </div>

        </form>


    </div>
</div>

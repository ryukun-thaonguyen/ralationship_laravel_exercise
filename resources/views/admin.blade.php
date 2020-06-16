<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title></title>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: darkslategrey">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation"></button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="#">Action 1</a>
                            <a class="dropdown-item" href="#">Action 2</a>
                        </div>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                   <form action="" method="post">
                       @csrf
                       <input type="text" hidden name="lastId" value="{{ $lastId }}">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" class="form-control" name="title" id="" aria-describedby="helpId" placeholder="">
                          </div>
                          <div class="form-group">
                              <label for="my-select">Category</label>
                              <select id="my-select" class="custom-select" name="category">
                                @foreach ($categories as $p)
                                <option value="{{ $p->id }}">{{ $p->name}}</option>
                                @endforeach
                              </select>
                          </div>
                        <div class="form-group">
                            <label for="tag" >Tag</label><br>
                            <input type="text" name="tag" id="tag" hidden value="">
                              @foreach ($tags as $p)
                              <input type="checkbox" name="checkBox" class="checkBox" value="{{ $p->id }}" id="">{{ $p->name }} <br>
                              @endforeach
                        </div>
                        <div class="form-group">
                            <label for="">Content</label>
                            <input type="text" class="form-control" name="content" id="" aria-describedby="helpId" placeholder="">
                        </div>
                        <div class="input-group">
                            <div class="custom-file" >
                            <input type="file" name="uploadImage"  id="uploadImage" value="" class="custom-file-input" >
                            <input type="number" hidden id="quantityImg" value="0">
                            <input type="text" name="image" id="image" value="" hidden>
                            <label class="input-group-text" type="button" for="uploadImage">Choose file</label>
                            </div>
                        </div>
                         <button type="submit" onclick="getTag()" class="btn btn-primary">Add</button>
                   </form>
                   <div class="row" id="preImg">

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <table class="table table-light">
                    <thead class="thead-dark">
                        <tr>
                            <th>id</th>
                            <th>title</th>
                            <th>category</th>
                            <th>image</th>
                            <th>tag</th>
                            <th>content</th>
                            <th>option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($photos as $p)
                               <tr>
                                   <td>
                                       {{ $p->id }}
                                   </td>
                                   <td>{{ $p->title }}</td>
                                   <td>{{ $p->category->name }}</td>
                                   <td>{{ $p->image }}</td>
                                   <td>
                                       @foreach ($p->tag as $t)
                                            {{ $t->name }},
                                       @endforeach
                                   </td>
                                   <td>{{ $p->photo_description->content }}</td>
                                   <td>
                                        <form action="delete" method="post">
                                            @csrf
                                            <input type="text" hidden name="photoId" value="{{ $p->id }}">
                                             <input type="text" hidden name="tags" value="{{ json_encode($p->tag) }}">
                                             <input type="text" hidden name="descriptions" value="{{ $p->photo_description->id }}">
                                             <button type="submit" style="width: 100px" class="btn btn-danger">delete</button>
                                        </form>
                                        <form action="edit" method="post">
                                            @csrf
                                            <input type="text" hidden name="photoId" value="{{ $p->id }}">
                                             <input type="text" hidden name="tags" value="{{ json_encode($p->tag) }}">
                                             <input type="text" hidden name="descriptions" value="{{ $p->photo_description->id }}">
                                             <button type="submit" style="width: 100px" class="btn btn-primary">edit</button>
                                        </form>
                                   </td>
                               </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="thead-dark">
                        <tr>
                            <th>id</th>
                            <th>title</th>
                            <th>category</th>
                            <th>image</th>
                            <th>tag</th>
                            <th>content</th>
                            <th>option</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script>
        function getTag(){
        var checkboxs=document.getElementsByName('checkBox');
        var tags=document.getElementById('tag').value;
        checkboxs.forEach(function(e){
            if(e.checked){
               tags+=e.value+" ";
            }
        })
        document.getElementById('tag').value=tags;
        console.log(tags);
        }

        $(function () {
        $("#uploadImage").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
    function imageIsLoaded(e) {
        if(el=document.getElementById('img')){
            document.getElementById('preImg').removeChild(el);
        }
        var card=document.createElement('div');
        card.id='img';
        card.className='card';
        var img=document.createElement('img');
        img.className='card-img-top';
        img.src=e.target.result;
        var label=document.createElement('label');
        label.style='text-align: center';
        label.innerHTML='<i  onclick ="remove()" class="fas fa-trash text-danger">';
        card.appendChild(img);card.appendChild(label);
        $('#preImg').append(card);
        document.getElementById('image').value=img.src;
    };
    function remove(){
        document.getElementById('image').value="";
        document.getElementById('preImg').removeChild(document.getElementById('img'));
    }
    </script>
</body>

</html>

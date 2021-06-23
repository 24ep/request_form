<!doctype html>
<html lang="en">
<head>
    <style>
    .tree_label {
        position: relative;
        display: inline-block;
        background: #fff;
        color: gray
    }
    .tree_label:after {
        position: absolute;
        top: 0em;
        left: -2.3em;
        display: block;
        height: 0.8em;
        width: 1.4em;
        border-bottom: 1px solid #777;
        border-left: 2px solid #777;
        border-radius: 0 0 0 .4em;
        content: '';
    }
    label.tree_label:hover {
        color: #666;
    }
    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Hello, world!</title>
</head>
<body>
    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <p>split to sub task table ---------------</p>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td colspan="4">
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action">A second link item</a>
                            <a href="#" class="list-group-item list-group-item-action">A third link item</a>
                            <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <th scope="row">NS-01</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr style="border:0px solid transparent ">
                    <th scope="row">
                        <ion-icon name="caret-down-outline"></ion-icon>
                    </th>
                    <th scope="row">NS-01</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr style="border:0px solid transparent;">
                    <th scope="row"></th>
                    <th scope="row" style="
      position: absolute;
       padding-left: 35px;
      border-left: 2px solid #777;
   margin-left:2em;
  height:50px
      "><span class="tree_label"> NS-01-1</span></th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr style="border:0px solid transparent;">
                    <th scope="row"></th>
                    <th scope="row" style="
      position: absolute;
      padding-left: 35px;
      border-left: 2px solid #777;
      margin-left:2em;
      height:50px
      "><span class="tree_label"> NS-01-2</span></th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <th scope="row" style="
      position: relative;
      padding-left: 69px;
      margin-left:2em;
      "><span class="tree_label"> NS-01-3</span></th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <th scope="row">NS-01</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
            </tbody>
        </table>
    </div>
    <p>split to sub task action --------------- </p>
    <div class="container">
        <div class="row mb-1">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Number</label>
            <div class="col-sm-7">
                <input type="email" class="form-control" id="inputEmail3" placeholder="10,40,23,45,45">
            </div>
            <div class="col-sm-3">
                <button type="button" class="btn btn-outline-primary">Split to subtask</button>
            </div>
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
    </div>
</body>
</html>
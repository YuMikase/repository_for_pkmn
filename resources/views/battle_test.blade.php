<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>battle_test</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/battle_test.css') }}">
<!--写真サイズ-->
    <style>
     .img_size{width: 150px;
	             height: 150px;}
    </style>

  </head>
  <body>
    <div class="grid-container">
      <div class="View bg-secondary">
          <p>view</p>
        <div class="row">
          <div class="col-md-6">
            <div class="progress">
              <div class="progress-bar w-75">
              </div>
            </div>
            <div class="progress">
              <div class="progress-bar w-75 progress-bar-animated">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <img alt="Bootstrap Image Preview" src="{{ asset('img/myu.jpg') }}" class="img_size">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <img alt="Bootstrap Image Preview" src="{{ asset('img/trainer.jpg') }}" class="img_size">
          </div>
          <div class="col-md-6">
            <div class="progress">
              <div class="progress-bar w-75">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="Info bg-success">
        <p>Info</p>
        <div class="row">
          <div class="col-md-6">
            <img alt="Bootstrap Image Preview" src="{{ asset('img/trainer.jpg') }}" class="img_size">
          </div>
          <div class="col-md-6">
            <p>infos</p>
            <h2>
              サンプル
            </h2>
            <p>
              ＃＃＃＃＃＃＃＃＃＃＃＃＃＃＃＃＃＃＃＃＃＃
            </p>
            <p>
              <a class="btn" href="#"></a>
            </p>
          </div>
        </div>
      </div>
      <div class="Chat bg-info">
        <form>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">chat</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="MESSAGE FROM YOUR MEMBERS"></textarea>
          </div>
        </form>
        <form class="form-inline">
            <input type="email" class="form-control w-75" placeholder="INPUT YOUR MESSAGE">
            <button type="submit" class="btn btn-primary mb-2 float-lg-none">SUBMIT</button>
        </form>
      </div>
      <div class="Action bg-warning">
        <div class="row row-cols-2 h-75">
          <div class="col">
            <button type="button" class="btn btn-success btn-lg btn-block mx-auto">
              コマンド１
            </button>
          </div>
          <div class="col">
            <button type="button" class="btn btn-success btn-lg btn-block mx-auto">
              コマンド2
            </button>
          </div>

          <div class="col">
            <button type="button" class="btn btn-success btn-lg btn-block mx-auto">
              コマンド3
            </button>
          </div>
          <div class="col">
            <button type="button" class="btn btn-success btn-lg btn-block mx-auto">
              コマンド４
            </button>
          </div>
         </div>
        <button type="button" class="btn btn-primary btn-lg btn-block ">Back</button>
      </div>
    </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

  </body>
</html>
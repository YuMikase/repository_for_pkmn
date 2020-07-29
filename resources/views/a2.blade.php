<!DOCTYPE html>
<html>
  <header>
    <title>A2</title>
    <link rel="stylesheet" href="{{ asset('css/styleA2.css') }}">
  </header>
  <body>
    <div id="div1">TITLE</div>
    <p id="name">Hello,####</p>
    <div ="selectlang">
    <select name="roomSelect" form="room" class="select">
      <option value="javascript">javascript</option>
      <option value="PHP">PHP</option>
      <option value="Python">Python</option>
    </select>
    <form method="POST" action="E2.html" id="room" class="enter">
      <input type="submit" onclick="location.href='./E2.html'"value="Enter" >
    </form >
  </div>
      <div id="clearfix"></div>
      <div id="div2">
        <div id="div2_1">
            <p id="status" ><a href="./index.html">Status<a></p>
            <p id="level">Level:##</p>
            <p id="money">Money:##</p>
            <p id="skill">skill</p>
        </div>
        <div id="div2_2">
              <p id="langLevel">Your Lang Lv.</p>
              <p id="javascriptLv">javascript:#</p>
              <p id="PHPLv">PHP:#</p>
              <p id="PythonLv">Python:#</p>
        </div>
</div>
      <div id="menu">
        <p>Items</p>
        <input type="button" onclick="location.href='./C1.html'" value="Use your Item">
        <input type="button" onclick="location.href='./D1.html'" value="Go shopping">
      </div>
    </body>
</html>

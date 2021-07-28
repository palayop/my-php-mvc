<?php
$this->scripts[] = URL_ROOT . '/js/pages/user/index.js';
?>
Hello world from user
<br>
<a href="<?= URL_ROOT ?>/user/logout">Smulate Logout</a>
<br>
<a href="<?= URL_ROOT ?>/home">Home</a>
<br>

<form class="row g-3">
    <div class="col-md-6">
        <label for="inputEmail4" class="form-label">Email</label>
        <input type="email" class="form-control" id="txtUser">
    </div>
    <div class="col-md-6">
        <label for="inputPassword4" class="form-label">Password</label>
        <input type="password" class="form-control" id="txtPassword">
    </div>
    <div class="col-12">
        <button id="btnSave" type="button" class="btn btn-primary">Save</button>
    </div>
    <br>
    <hr>
    Result
    <br>
    <div id="dvResult"></div>
</form>
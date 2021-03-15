<div class="container mt-3">
    <div class="justify-content-md-center col-6 bg-dark text-light p-3">
    <h1>Login</h1>
    <form action="<?=base_url()?>" method="post">
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" name="email" id="email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password">
            <input type="hidden" name="login" value="1">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </form>
    </div>
</div>
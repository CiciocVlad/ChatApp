<?php include_once "header.php"; ?>
<body>
    <div class="wrapper">
        <section class="form login">
            <header>Chat App</header>
            <form action="#">
                <div class="error-txt"></div>
                <div class="field input">
                    <label>Email Adress</label>
                    <input type="text" name="email" placeholder="example@company.com">
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter your password">
                </div>
                <div class="field button">
                    <input type="submit" value="Continue to Chat">
                </div>
            </form>
            <div class="link">Don't have an account ? <a href="index.php">Sign up</a></div>
        </section>
    </div>
	<script src="static/js/login.js"></script>
</body>
</html>
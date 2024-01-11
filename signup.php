<?php
    include_once 'header.php';
?>


<style>
    main {
        margin: 60px 10px;
        padding: 20px 10px;
        align-items: center;
    }
	.signup-full {
		z-index: 1;
		display: block;
		margin: 30px auto;
		padding: 50px 40px;
		background-color: black;
		border-radius: 10px;
		max-width: 500px;
		font-size: 13px;
	}

	.signup-form {
		margin: auto;
		padding: 50px 25px;
		z-index: 2;
		text-align: center;
		box-shadow: 0 0 10px 5px rgba(0, 0, 0, 0.1);
		border-radius: 10px;
		max-width: 420px;
		display: block;
		background-color: white;
	}

	.divider:after,
	.divider:before {
		content: "";
		flex: 1;
		height: 1px;
		background: gray;
	}

	#facebook,
	#google {
		width: 100%;
		border: none;
	}

	.text-box {
		margin-bottom: 12px;
		width: 100%;
		height: 40px;
		border-radius: 5px;
		border: none;
		

		padding: 12px;
		resize: vertical;
		box-shadow: 0 0 10px 5px rgba(0, 0, 0, 0.1);
		border-radius: 5px;
		border: none;
	}

	button{
		width: 100%;
		height: 40px;
		border-radius: 5px;
		border: none;
		font-size: 15px;
		margin-bottom: 12px;
        font-weight: 600;
        background-color: rgb(31, 147, 255);
		
	}
	button a, button i{
		color: white;
	}
    .col-md-6{
        width: 50%;
    }
</style>

<div class="main-topic" style="margin: 60px auto;">
    <h2>My Account</h2>
</div>

<section class="signup-full">
    <div class="signup-form">
        <h2 class="text-uppercase text-center mb-5">Register</h2>

        <form action="./include/signup.inc.php" method="POST">

            <div class="row">
                <div class="col-md-6">
                    <div>
                        <input type="text" name="fname" class="text-box" placeholder="First Name" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div>
                        <input type="text" name="lname" class="text-box" placeholder="Last Name" required />
                    </div>
                </div>
            </div>

            <div>
                <input type="email" name="email" class="text-box" placeholder="Email" required />
            </div>

            <div>
                <input type="password" name="passwd" class="text-box" placeholder="Passwaord" required />
            </div>

            <div>
                <input type="password" name="re_passwd" class="text-box" placeholder="Repeat Password" required />
            </div>

            <div class="form-check d-flex justify-content-center mb-1">
            </div>

            <button class="button" name="submit" type="submit">Login</button>

			<div class="divider d-flex align-items-center my-2">
				<p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
			</div>
				
            <button class="button" style="background-color: #3b5998;" type="submit" id="facebook"><i class="fab fa-facebook-f me-2"></i><a href="https://www.facebook.com/">Sign in with facebook</a></button>
			<button class="button" style="background-color: #dd4b39;" type="submit" id="google"><i class="fab fa-google me-2"></i> Sign in with google</button>

        </form>

        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo '<div class="error">Fill all fields</div>';
            } else if ($_GET["error"] == "invalidEmail") {
                echo '<div class="error">Enter valid Email</div>';
            } else if ($_GET["error"] == "passwordDoesnotMatch") {
                echo '<div class="error">check password</div>';
            } else if ($_GET["error"] == "stmtfailed") {
                echo '<div class="error">Something Wrong</div>';
            } else if ($_GET["error"] == "UserAlreadyExisting") {
                echo '<div class="error">Email or Mobile already created account</div>';
            }
        }
        ?>

    </div>
</section>

<?php
    include_once 'footer.php';
?>
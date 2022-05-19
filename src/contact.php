<?php include('header.php'); ?>

<div class="content">
    <section>
        <div class="col-md-6">
            <label for="firstName" class="form-label">First name</label>
            <input type="text" class="form-control" id="firstName" name="FirstName" required="required">
        </div>
        <div class="col-md-6">
            <label for="lastName" class="form-label">Last name</label>
            <input type="text" class="form-control" id="lastName" name="LastName" required="required">
        </div>
        <div class="col-md-12">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="Email" required="required">
        </div>
        <div class="col-12">
            <label for="enquiries" class="form-label">Reason for contacting</label>
            <input type="text" class="form-control" id="enquiries" placeholder="Please type your reason here." name="enquiries">
            <div>
                <input type="submit" value="Submit">
            </div>
        </div>
        </form>
    </section>
</div>
<?php include_once('partials/footer.php'); ?>
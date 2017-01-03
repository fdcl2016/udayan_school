<footer id="footer">
    <div class="container">
        <section>
            <article class="col-1">
                <h3>Contact</h3>
                <ul>

                    <li class="address"><a href="#">3/3 Fuller Road<br>Dhaka University Campus<br>Dhaka 1000<br>Bangladesh</a></li>
                    <li class="mail"><a href="#">udayan@fourdbd.com</a></li>
                    <li class="phone last"><a href="#">+880 2 8631625</a></li>
                </ul>
            </article>
            <article class="col-2">
                <h3>News</h3>
                <ul>

                    <?php
                    $i=0;
                    foreach($news as $new)
                    {
                        $title=$new['title'];


                        ?>

                        <li><a href="#"><?php echo($title); ?></a></li>


                        <?php
                        $i++;
                    }
                    ?>



                </ul>
            </article>
            <article class="col-3">
                <h3>Social media</h3>
                <ul>
                    <li class="facebook"><a href="#">Facebook</a></li>
                    <li class="google-plus"><a href="#">Google+</a></li>
                    <li class="twitter"><a href="#">Twitter</a></li>
                    <li class="pinterest"><a href="#">Pinterest</a></li>
                </ul>
            </article>
            <article class="col-4">
                <h3>Newsletter</h3>

                <form action="#">
                    <input placeholder="Email address..." type="text">
                    <button type="submit">Subscribe</button>
                </form>
                <ul>
                    <li><a href="#"></a></li>
                </ul>
            </article>
        </section>
        <p class="copy">Copyright 2015 Four D Communications Limited. All rights reserved.</p>
    </div>
</footer>

<!-- Modal -->
<div class="modal fade" id="contact" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="padding:35px 50px;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3><span class="glyphicon glyphicon-send"></span> Send Udayan a message</h3>
            </div>
            <div class="modal-body" style="padding:40px 50px;">
                <form>
                    <div class="form-group">
                        <label class="sr-only" for="name">Your Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Your Name" maxlength="60">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="email">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Email" maxlength="60">
                    </div>
<div class="form-group">
                        <label class="sr-only" for="mobile">Your Mobile Number</label>
                        <input type="number" class="form-control" id="mobile" placeholder="Your Mobile Number">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="5" name="message" placeholder="Write Your Message" maxlength="200" style="resize:vertical;"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" data-dismiss="modal"><span class="glyphicon glyphicon-send"></span> Send</button>
                <button type="submit" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
            </div>
        </div>

    </div>
</div>
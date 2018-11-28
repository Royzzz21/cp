
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top" style="background-color:#788d98;">
    <div style="">
        <div class="container-fluid" style="background-color:;max-width:1200px;border:0px solid red;overflow:hidden;margin:0 auto;">
            <!-- Brand and toggle get grouped for better mobile display -->

            <div class="navbar-header" style="border:0px solid red;">
                <h1 style="position:absolute;left:0; display: block;">
                    <a class="navbar-brand page-scroll" href="/">
                        <img src="/img/logo.png" alt="Logo">
                    </a>
                </h1>
                {{--
                <!-- language selector -->
                <div class="global">
                    <select>
                        <option value="KO" selected>KO</option>
                        <option value="EN">EN</option>
                        <option value="CH">CN</option>
                    </select>
                </div>--}}
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> <i class="fa fa-bars"></i>
                </button>
            </div>
.
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="position:absolute;right:100px;">
                <ul class="nav navbar-nav navbar-right" style="background-color: ; margin-right: 10px;">
                    <li>
                        <a class="page-scroll" href="/project">Project</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="/task">Task</a>
                    </li>

                    <li>
                        <a class="page-scroll" href="/schedule">Schedule</a>
                    </li>

                    <li>
                        <a class="page-scroll" href="/docs">Documents</a>
                    </li>


                    <li>
                        <a class="page-scroll" href="/qna">Q &amp; A</a>
                    </li>


                    <li>
                        <a class="page-scroll" href="/faq">FAQ</a>
                    </li>
                    <?php

                        // if we logged?
                        if(glo()->is_logged) {
                            ?>
                            <li>
                            <a class="page-scroll" href="/logout">LOGOUT</a>
                            </li>
                            <?php
                        } else {
                            ?>

                            <li>
                            <a class="page-scroll" href="/login">LOGIN</a>
                            </li>
                            <?php
                        }


                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
    </div>

    <!-- /.container-fluid -->
</nav>

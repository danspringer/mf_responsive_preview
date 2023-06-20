<?php
$url = $_GET['url'];
?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Responsive Previewer</title>

    <!--[if IE]>
    <meta http-equiv="imagetoolbar" content="no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->

    <meta name="robots" content="noindex, nofollow">
    <script src="js/libs/modernizr.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/resizer.css" rel="stylesheet">

</head>
<body>

    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="smartphone" viewBox="0 0 16 16">
            <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z"/>
            <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
        </symbol>
        <symbol id="tablet" viewBox="0 0 16 16">
            <path d="M12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h8zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z"/>
            <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
        </symbol>
        <symbol id="laptop" viewBox="0 0 16 16">
            <path d="M13.5 3a.5.5 0 0 1 .5.5V11H2V3.5a.5.5 0 0 1 .5-.5h11zm-11-1A1.5 1.5 0 0 0 1 3.5V12h14V3.5A1.5 1.5 0 0 0 13.5 2h-11zM0 12.5h16a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5z"/>
        </symbol>
        <symbol id="desktop" viewBox="0 0 16 16">
            <path
                d="M0 4s0-2 2-2h12s2 0 2 2v6s0 2-2 2h-4c0 .667.083 1.167.25 1.5H11a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1h.75c.167-.333.25-.833.25-1.5H2s-2 0-2-2V4zm1.398-.855a.758.758 0 0 0-.254.302A1.46 1.46 0 0 0 1 4.01V10c0 .325.078.502.145.602.07.105.17.188.302.254a1.464 1.464 0 0 0 .538.143L2.01 11H14c.325 0 .502-.078.602-.145a.758.758 0 0 0 .254-.302 1.464 1.464 0 0 0 .143-.538L15 9.99V4c0-.325-.078-.502-.145-.602a.757.757 0 0 0-.302-.254A1.46 1.46 0 0 0 13.99 3H2c-.325 0-.502.078-.602.145z"/>
        </symbol>
        <symbol id="xl-desktop" viewBox="0 0 16 16">
            <path
                d="M2.5 13.5A.5.5 0 0 1 3 13h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zM13.991 3l.024.001a1.46 1.46 0 0 1 .538.143.757.757 0 0 1 .302.254c.067.1.145.277.145.602v5.991l-.001.024a1.464 1.464 0 0 1-.143.538.758.758 0 0 1-.254.302c-.1.067-.277.145-.602.145H2.009l-.024-.001a1.464 1.464 0 0 1-.538-.143.758.758 0 0 1-.302-.254C1.078 10.502 1 10.325 1 10V4.009l.001-.024a1.46 1.46 0 0 1 .143-.538.758.758 0 0 1 .254-.302C1.498 3.078 1.675 3 2 3h11.991zM14 2H2C0 2 0 4 0 4v6c0 2 2 2 2 2h12c2 0 2-2 2-2V4c0-2-2-2-2-2z"/>
        </symbol>
        <symbol id="icon-rotate" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
            <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
        </symbol>
    </svg>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark py-0" id="header">
        <div class="container">
            <div class="mx-auto">
                <nav class="d-flex">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="#" class="phone nav-link active" data-res="390x800" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Smartphone">
                                <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                                    <use xlink:href="#smartphone"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="tabletvertical nav-link" data-res="768x1024" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Tablet">
                                <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                                    <use xlink:href="#tablet"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="laptop nav-link" data-res="1024x768" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Laptop">
                                <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                                    <use xlink:href="#laptop"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="desktop nav-link" data-res="1280x1024" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Desktop">
                                <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                                    <use xlink:href="#desktop"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="desktop-xl nav-link" data-res="1900x1280" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="XL-Desktop">
                                <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                                    <use xlink:href="#xl-desktop"></use>
                                </svg>
                            </a>
                        </li>
                    </ul>
                    <form class="resolution my-auto ms-4">
                        <div class="input-group">
                            <input id="resolution" class="form-control p-0 text-center border-0 text-dark bg-secondary" type="text">
                            <button class="btn btn-outline-secondary" type="submit">Los</button>
                        </div>
                    </form>
                </nav>
            </div>
        </div>
    </nav>


    <div id="main">

        <div id="linehorizontal">
            <div class="left"></div>
            <div class="right"></div>
            <div class="center">390px</div>
        </div>

        <div id="linevertical">
            <div class="top"></div>
            <div class="middle">800px</div>
            <div class="bottom"></div>
        </div>

        <a href="#" id="rotate">
            <svg class="bi d-block mx-auto" width="30" height="30">
                <use xlink:href="#icon-rotate"></use>
            </svg>
        </a>

        <!-- Main Action hier -->
        <div id="viewer">
            <iframe src="<?= $url ?>">
            </iframe>
        </div>

    </div>

    <div id="overlay"></div>

    <script src="js/libs/popper.min.js"></script>
    <script src="js/libs/bootstrap.min.js"></script>
    <script src="js/libs/jquery-3.7.0.min.js"></script>
    <script src="js/libs/jquery.transit.min.js"></script>
    <script src="js/resizer.js"></script>

</body>
</html>
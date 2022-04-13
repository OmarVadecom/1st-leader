@extends('site.layouts.default')
@section('content')
<br>

<div class="packages p-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                        <h3>Style 1 </h3><br>
                    <!-- Box-1 -->
                    <div class="box text-center">
                        <h3>Website Design</h3>
                        <div class="price">
                            <span>$200</span>
                        </div>
                        <ul class="list-unstyled">
                            <li><span class="fas fa-check"></span> Layout Web Design</li>
                            <li> 5 Page Website</li>
                            <li> CMS System</li>
                            <li> 500 Mb Hosting</li>
                            <li> 5 Mail Accounts</li>
                            <li> Layout Web Design</li>
                        </ul>
                        <a href="" class="btn">Buy Now</a>
                    </div>
                    <!--End Box-1 -->
                </div>
                <div class="col-lg-4">
                    <h3>Style 2 </h3><br>
                      <!-- Box-2 -->
                    <div class="box-2 text-center">
                        <h3>Website Design</h3>
                        <div class="price">
                            <span>$200</span>
                        </div>
                        <ul class="list-unstyled">
                            <li> Layout Web Design</li>
                            <li> 5 Page Website</li>
                            <li> CMS System</li>
                            <li> 500 Mb Hosting</li>
                            <li> 5 Mail Accounts</li>
                            <li> Layout Web Design</li>
                        </ul>
                        <a href="" class="btn">Buy Now</a>
                    </div>
                    <!-- End Box-2 -->
                </div>
                <div class="col-lg-4">
                        <h3>Style 3 </h3><br>
                    <!-- Box-3 -->
                    <div class="box-3 text-center">
                        <h3> SIMPLE WEBSITE</h3>
                        <div class="price">
                            <span>200<sup>$</sup></span>
                        </div>
                        <div class="title">Website</div>
                        <ul class="list-unstyled">
                            <li> Layout Web Design</li>
                            <li> 5 Page Website</li>
                            <li> CMS System</li>
                            <li> 500 Mb Hosting</li>
                            <li> 5 Mail Accounts</li>
                            <li> Layout Web Design</li>
                        </ul>
                        <a href="" class="btn">Buy</a>
                    </div>
                    <!-- End Box-3 -->

                </div>
            </div>
        </div>
    </div>

    <style>

        h3{
            text-align: center;
        }
.packages {
    background-color: rgba(200, 216, 218, 0.34)
}
.packages .box {
    background-color: #fff;
    padding-bottom: 20px
}
.packages .box h3 {
    padding: 10px;
    font-size: 17px;
    background-color: #df3120;
    color: #fff;
    text-transform: uppercase;
    margin: 0;
}
.packages .box .price {
    background-color: #0171BC;
    position: relative;
    width: 104%;
    left: -8px;
    height: 100px;
    clip-path: polygon(50% 0%, 100% 0, 100% 67%, 50% 100%, 0% 67%, 0 0);
    color: #fff;
    font-size: 38px;
    font-weight: bold;
    padding: 10px;
    text-align: center;
}
.packages .box ul li {
    color: #9e9e9e;
    font-size: 16px;
    padding: 8px 0;
}
.packages .box .btn {
    background-color: #df3120;
    color: #fff;
    border-radius: 100px;
    width: 50%;
    padding: 10px;
    text-transform: uppercase;
    font-size: 14px;
}




/* Box-2 */
.packages .box-2 {
    background-color: #fff;
    padding-bottom: 20px
}
.packages .box-2 h3 {
    padding: 10px;
    font-size: 17px;
    background-color: #df3120;
    color: #fff;
    text-transform: uppercase;
    margin: 0;
}
.packages .box-2 .price {
    background-color: #0f4d90;
    position: relative;
    width: 100%;
    left: 0;
    height: 50px;
    color: #fff;
    text-align: center;
    margin-bottom: 77px;
    padding: 6px;
}
.packages .box-2 ul li {
    color: #9e9e9e;
    font-size: 16px;
    padding: 8px 0;
}
.packages .box-2 .btn {
    background-color: #0171bc;
    color: #fff;
    border-radius: 100px;
    width: 50%;
    padding: 10px;
    text-transform: uppercase;
    font-size: 14px;
}
.packages .box-2 .price span {
    display: inline-block;
    background-color: #0171bc;
    width: 110px;
    height: 110px;
    border-radius: 50%;
    padding: 30px 20px;
    text-align: center;
    font-size: 28px;
    font-weight: bold;
    border: 4px solid #fff;
}


/* Box-3 */
.packages .box-3 {
    background-color: #fff;
    padding-bottom: 20px
}
.packages .box-3 h3 {
    padding: 10px;
    font-size: 26px;
    background-image: linear-gradient(to left, #bb2011, #cc3322, #dd4433, #ee5443, #ff6454);
    color: #fff;
    text-transform: uppercase;
    margin: 0;
}

.packages .box-3 ul li {
    color: #9e9e9e;
    font-size: 16px;
    padding: 8px 0;
}
.packages .box-3 .btn {
    background-image: linear-gradient(to left, #0171bc, #0067ab, #005d9a, #00538a, #01497a);
    color: #fff;
    border-radius: 100px;
    width: 50%;
    padding: 10px;
    text-transform: uppercase;
    font-size: 14px;
}
.packages .box-3 .price {
    font-size: 44px;
    padding: 10px;
    color: #ccc;
}
.packages .box-3 .title {
    position: absolute;
    right: 3px;
    background-image: linear-gradient(to left, #0171bc, #0067ab, #005d9a, #00538a, #01497a);
    padding: 4px 19px;
    color: #fff;
}
.packages .box-3 .title::after {
    content: '';
    position: absolute;
    right: 0;
    bottom: -15px;
    clip-path: polygon(0 0, 100% 0, 0 100%, 0 100%);
    background-image: linear-gradient(to left, #0171bc, #0067ab, #005d9a, #00538a, #01497a);
    width: 24px;
    height: 15px;
    z-index: -1;
}


@media only screen and (min-width:300px) and (max-width:780px) {
	.packages {
		padding: 10px 0 !important;

	}
	.packages  .box {
		margin-bottom:20px;
	}
}


        </style>

        @endsection
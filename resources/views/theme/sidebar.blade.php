<div class="navbar-default sidebar" role="navigation">

    <div class="sidebar-nav navbar-collapse">

        <ul class="nav" id="side-menu">
            <!--
            <li class="sidebar-search">

                <div class="input-group custom-search-form">

                    <input type="text" class="form-control" placeholder="Search...">

                    <span class="input-group-btn">

                    <button class="btn btn-default" type="button">

                        <i class="fa fa-search"></i>

                    </button>

                </span>

                </div>

                
            </li>
            -->
            <li>

                <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>

            </li>

            <li>

                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Quản lý kho<span class="fa arrow"></span></a>
                 
                <ul class="nav nav-second-level">

                    <li>

                        <a href="{{ url('ql-nhacungcap') }}">Nhà cung cấp</a>

                    </li>
                    <li>

                        <a href="{{ url('ql-sanpham') }}">Vật liệu</a>

                    </li>
                    <li>

                        <a href="morris.html">Kho vật liệu chính</a>

                    </li>
                    <li>

                        <a href="morris.html">Kho vật liệu hỏng</a>

                    </li>

                </ul>

                <!--/.nav-second-level -->

            </li>

            <li>

                <a href="{{ url('nhap-kho') }}"><i class="fa fa-table fa-fw"></i> Nhập kho</a>

            </li>

            <li>

                <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Xuất kho</a>

            </li>

            <li>

                <a href="#"><i class="fa fa-wrench fa-fw"></i> Thống kê<span class="fa arrow"></span></a>

                 
                <ul class="nav nav-second-level">

                    <li>

                        <a href="panels-wells.html">Thống kê Xuất kho</a>

                    </li>
                    <li>

                        <a href="panels-wells.html">Thống kê nhập kho</a>

                    </li>

                </ul>


            </li>
            <li>

                <a href="forms.html"><i class="fa fa-edit fa-fw"></i>Quản lý hàng hư</a>

            </li>
            <li>

                <a href="forms.html"><i class="fa fa-edit fa-fw"></i>Quản lý khách hàng</a>

            </li>
            <li>

                <a href="#"><i class="fa fa-files-o fa-fw"></i> Kiểm tra hàng tồn kho</a>
<!-- 
                <ul class="nav nav-second-level">
                
                    <li>

                        <a href="blank.html">Blank Page</a>

                    </li>

                    <li>

                        <a href="login.html">Login Page</a>

                    </li>

                </ul>

                /.nav-second-level -->

            </li>
            <li>

                <a href="forms.html"><i class="fa fa-edit fa-fw"></i>Quản lý hàng hư</a>

            </li>
            
        </ul>

    </div>

    <!-- /.sidebar-collapse -->

</div>

<!-- /.navbar-static-side -->
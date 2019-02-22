<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        
        <!-- Top Navigation: Toggle Menu -->
        <button type="button" class="navbar-toggle pull-left" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        
        <!-- Top Navigation: Brand -->
        <div class="navbar-header">
            <a class="navbar-brand" href="./"><i class="fa fa-home fa-fw"></i>Taskboard</a>
        </div>
        
        <!-- Top Navigation: Right Menu -->
        <ul class="nav navbar-right navbar-top-links">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" >
                    <i class="fa fa-bell fa-fw"></i>
                    <span class="notify notify-danger notify-top notify-right" id="notify-badge">5</span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a >
                            <div>
                                <i class="fa fa-comment fa-fw"></i> New Comment
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a >
                            <div>
                                <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                <span class="pull-right text-muted small">12 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a >
                            <div>
                                <i class="fa fa-envelope fa-fw"></i> Message Sent
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a >
                            <div>
                                <i class="fa fa-tasks fa-fw"></i> New Task
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a >
                            <div>
                                <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" >
                            <strong>Ver todo</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" >
                    <i class="fa fa-user fa-fw"></i> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li>
                        <a><span id="info_username"></span></a>
                    <li class="divider"></li>
                    </li>
                    <li>
                        <a href="perfil"><i class="fa fa-user fa-fw"></i> Perfil</a>
                    </li>
                    <li>
                        <a><i class="fa fa-gear fa-fw"></i> Ajustes</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="logout"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                    </li>
                </ul>
            </li>
        </ul>

        
    </nav>
    <!-- Sidebar -->
    <div class="sidebar navbar-default" role="navigation">
        <div class="sidebar-nav navbar-collapse">

            <ul class="nav" id="side-menu">
                <li>
                    <div class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control datepicker-field" placeholder="Buscar...">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="inicio"><i class="fa fa-dashboard fa-fw"></i> Inicio</a>
                </li>
                <li>
                    <a href="administrar"><i class="fa fa-bar-chart-o fa-fw"></i> Administrar</a>
                </li>
                <li>
                    <a href="tareas"><i class="fa fa-tasks fa-fw"></i> Tareas</a>
                </li>
                <li>
                    <a href="perfil"><i class="fa fa-user fa-fw"></i> Perfil</a>
                </li>
            </ul>

        </div>
    </div>
    <script>LOGGED = true;</script>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div id="bc"></div>
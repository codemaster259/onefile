<div>
<div>
<div>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Top Navigation: Brand -->
    <div class="navbar-header">
        <a class="navbar-brand" href="./"><i class="fa fa-home fa-fw"></i>Taskboard</a>
    </div>
    
    <!-- Top Navigation: Left Menu -->
    <ul class="nav navbar-nav navbar-right navbar-top-links">
        <li><a href="login"><i class="fa fa-sign-in fa-fw"></i> Iniciar Sesion</a></li>

        <?php if(env("APP.allowRegister", false)):?>
        <li><a href="registro"><i class="fa fa-user-plus fa-fw"></i> Registro</a></li>
        <?php endif;?>
        
    </ul>
    
</nav>
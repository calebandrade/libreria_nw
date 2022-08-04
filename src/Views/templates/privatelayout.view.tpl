<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{SITE_TITLE}}</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/{{BASE_DIR}}/public/css/appstyle.css" />
  <script src="https://kit.fontawesome.com/{{FONT_AWESOME_KIT}}.js" crossorigin="anonymous"></script>
  {{foreach SiteLinks}}
  <link rel="stylesheet" href="/{{~BASE_DIR}}/{{this}}" />
  {{endfor SiteLinks}}
  {{foreach BeginScripts}}
  <script src="/{{~BASE_DIR}}/{{this}}"></script>
  {{endfor BeginScripts}}
</head>

<body>
  <header>
    <input type="checkbox" class="menu_toggle" id="menu_toggle" />
    <label for="menu_toggle" class="menu_toggle_icon">
      <div class="hmb dgn pt-1"></div>
      <div class="hmb hrz"></div>
      <div class="hmb dgn pt-2"></div>
    </label>
    <h1>{{SITE_TITLE}}</h1>
    <nav id="menu">
      <ul>
        <li><a href="index.php?page=admin_admin"><i class="fas fa-home"></i>&nbsp;Inicio</a></li>
        {{foreach NAVIGATION}}
            <li><a href="{{nav_url}}">{{nav_label}}</a></li>
        {{endfor NAVIGATION}}
        <li><a href="index.php?page=mnt_editorials"><i class="fas fa-sign-out-alt"></i>&nbsp;Editoriales</a></li>
        <li><a href="index.php?page=mnt_categorias"><i class="fas fa-sign-out-alt"></i>&nbsp;Géneros</a></li>
        <li><a href="index.php?page=mnt_libros"><i class="fas fa-sign-out-alt"></i>&nbsp;Libros</a></li>
        <li><a href="index.php?page=mnt_ventas"><i class="fas fa-sign-out-alt"></i>&nbsp;Ventas</a></li>
        <li><a href="index.php?page=mnt_usuarios"><i class="fas fa-sign-out-alt"></i>&nbsp;Usuarios</a></li>
        <li><a href="index.php?page=mnt_roles"><i class="fas fa-sign-out-alt"></i>&nbsp;Roles</a></li>
        <li><a href="index.php?page=mnt_funciones"><i class="fas fa-sign-out-alt"></i>&nbsp;Funciones</a></li>
        <li><a href="index.php?page=mnt_librosClient"><i class="fas fa-sign-out-alt"></i>&nbsp;Libros Tienda</a></li>
        <li><a href="index.php?page=sec_logout"><i class="fas fa-sign-out-alt"></i>&nbsp;Salir</a></li>
      </ul>
    </nav>
    {{with login}}
    <span class="username">{{userName}} <a href="index.php?page=sec_logout"><i class="fas fa-sign-out-alt"></i></a></span>
    {{endwith login}}
  </header>
  <main>
    {{{page_content}}}
  </main>
  <footer>
    <div>Todo los Derechos Reservados 2021 &copy;</div>
  </footer>
  {{foreach EndScripts}}
  <script src="/{{~BASE_DIR}}/{{this}}"></script>
  {{endfor EndScripts}}
</body>
</html>

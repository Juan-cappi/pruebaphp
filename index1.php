<?php
$guerreros = [
    'goku' => [
        'nombre' => 'Son Goku',
        'raza' => 'Saiyan',
        'descripcion' => 'El héroe principal y protector de la Tierra. Maestro del Kamehameha.',
        'imagen' => 'https://elcomercio.pe/resizer/v2/6Y2EDIISGFGVFANEVDCR5LCG34.jpg?auth=f58b5c647a09717054d85bb8b9a6bc624bfcb14fe9c60b5246730ea6a513e2b0&width=1198&height=690&quality=75&smart=true',
        'poder' => 'Infinito',
    ],
    'vegeta' => [
        'nombre' => 'Vegeta',
        'raza' => 'Saiyan',
        'descripcion' => 'Príncipe de los Saiyans y eterno rival de Goku. Orgulloso y poderoso.',
        'imagen' => 'https://i.blogs.es/b60b7d/vegeta/650_1200.jpeg',
        'poder' => 'Infinito, pero menor que Goku',
    ],
    'piccolo' => [
        'nombre' => 'Piccolo',
        'raza' => 'Namekiano',
        'descripcion' => 'Guerrero Namekiano. Aliado de Goku y mentor de Gohan.',
        'imagen' => 'https://i.pinimg.com/736x/5e/5f/58/5e5f5829bb8b3066ff981d83f44c56f8.jpg',
        'poder' => 5000,
    ],
    'freezer' => [
        'nombre' => 'Freezer',
        'raza' => 'Villano',
        'descripcion' => 'Tirano galáctico. Responsable de la destrucción del Planeta Vegeta.',
        'imagen' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSJBSsFQGa0A7UV2AVATGZK-X1ko4Q_aU-kJA&s',
        'poder' => 12000,
    ],
    'gohan' => [
        'nombre' => 'Gohan',
        'raza' => 'Híbrido Saiyan',
        'descripcion' => 'Hijo de Goku. Desata un gran poder cuando se enfada.',
        'imagen' => 'https://i.pinimg.com/originals/9d/ef/3f/9def3f29cdf1beeaad854bbf221f6f24.jpg',
        'poder' => 'Infinito; cuando se enoja supera a su padre',
    ],
    'videl' => [
        'nombre' => 'Videl',
        'raza' => 'Humano',
        'descripcion' => 'Hija de Mr. Satán. Aprende a controlar el Ki bajo la tutela de Gohan.',
        'imagen' => 'https://pm1.aminoapps.com/6723/c1141023c478449e4d402698ef707596727c97bfv2_hq.jpg',
        'poder' => 50,
    ],
    'krilin' => [
        'nombre' => 'Krilin',
        'raza' => 'Humano',
        'descripcion' => 'Mejor amigo de Goku. Gran espíritu de lucha (PD: ¡se muere a cada rato! 😅).',
        'imagen' => 'https://i.pinimg.com/736x/a4/bb/c2/a4bbc2900ba336af1e6d7ce1738a69c0.jpg',
        'poder' => 150,
    ],
    'cell' => [
        'nombre' => 'Cell',
        'raza' => 'Androide',
        'descripcion' => 'Bio-Androide diseñado para ser la criatura perfecta.',
        'imagen' => 'https://i0.wp.com/codigoespagueti.com/wp-content/uploads/2024/02/dragon-ball-unico-personaje-transformaciones-cell.jpg',
        'poder' => 10000,
    ],
];

// Tema (?tema=claro|oscuro)
$tema = $_GET['tema'] ?? 'claro';
$tema = in_array($tema, ['claro','oscuro'], true) ? $tema : 'claro';
$clase_tema = 'tema-' . $tema;

// Parámetros GET: buscar por nombre y filtrar por raza
$buscar = trim($_GET['buscar'] ?? '');
$filtro_raza = $_GET['raza'] ?? '';

// Filtrado
$personajes = $guerreros;
if ($buscar !== '') {
    $personajes = array_filter($personajes, function($p) use($buscar) {
        return stripos($p['nombre'], $buscar) !== false;
    });
}
if ($filtro_raza !== '') {
    $personajes = array_filter($personajes, function($p) use($filtro_raza) {
        return $p['raza'] === $filtro_raza;
    });
}

// RAZAS únicas para el <select>
$razas = array_values(array_unique(array_map(fn($p) => $p['raza'], $guerreros)));
sort($razas);

// Manejo POST: sugerencia de nuevo ítem
$mensaje_post = '';
$error_post = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_sugerido = trim($_POST['nombre_sugerido'] ?? '');
    $desc_sugerida   = trim($_POST['desc_sugerida'] ?? '');

    if ($nombre_sugerido === '' || $desc_sugerida === '') {
        $error_post = '¡ERROR! Faltó completar el nombre y/o la descripción.';
    } else {
        $mensaje_post = 'Sugerencia de "' . ($nombre_sugerido) . '" recibida. Descripción: ' . ($desc_sugerida) . '.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>DBZ — Listado de Guerreros</title>
<style>
    :root{
        --bg: #ffffff;
        --text: #111111;
        --card-bg: #f6f6f6;
        --card-bd: #dddddd;
        --acc: #0b5ed7;
        --ok: #0a7b34;
        --err: #b00020;
    }
    .tema-oscuro{
        --bg: #0e1116;
        --text: #e8eef6;
        --card-bg: #141922;
        --card-bd: #2a3242;
        --acc: #5aa9ff;
        --ok: #2dd36f;
        --err: #ff6b6b;
    }
    body{
        margin: 0; padding: 1rem;
        background: var(--bg); color: var(--text);
        font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
    }
    header{ display:flex; gap:1rem; align-items:center; flex-wrap:wrap; }
    h1{ margin:0; font-size:1.6rem; }
    .panel{
        display:flex; gap:1rem; align-items:end; flex-wrap:wrap;
        margin-top:.75rem; padding: .75rem; border:1px solid var(--card-bd); border-radius:12px; background:var(--card-bg);
    }
    .panel label{ font-size:.9rem; display:block; margin-bottom:.25rem; }
    .panel input[type="text"], .panel select{
        padding:.5rem .6rem; border:1px solid var(--card-bd); border-radius:8px; background:var(--bg); color:var(--text);
    }
    .panel button, .panel input[type="submit"]{
        padding:.6rem 1rem; border:1px solid var(--acc); background:transparent; color:var(--acc);
        border-radius:999px; cursor:pointer; font-weight:600;
    }
    .panel button:hover, .panel input[type="submit"]:hover{ background:var(--acc); color:#fff; }
    .grid{
        display:grid; grid-template-columns: repeat(auto-fill, minmax(240px,1fr)); gap:1rem; margin-top:1rem;
    }
    .card{
        border:1px solid var(--card-bd); border-radius:14px; overflow:hidden; background:var(--card-bg);
        display:flex; flex-direction:column;
    }
    .card img{ width:100%; aspect-ratio:16/9; object-fit:cover; }
    .card .box{ padding:.75rem .9rem; }
    .tag{ display:inline-block; font-size:.75rem; padding:.2rem .5rem; border:1px solid var(--card-bd); border-radius:999px; opacity:.9; }
    .poder{ font-size:.85rem; opacity:.9; }
    .muted{ opacity:.8; }
    .msg{ margin-top:1rem; padding:.8rem 1rem; border-radius:12px; }
    .msg.ok{ border:1px solid var(--ok); color:var(--ok); }
    .msg.err{ border:1px solid var(--err); color:var,--err; }
    footer{ margin-top:2rem; font-size:.9rem; opacity:.75; }

    /* Animaciones y hover */
    .grid .card{
        opacity: 0;
        transform: translateY(10px) scale(.995);
        animation: cardIn .44s cubic-bezier(.2,.9,.3,1) forwards;
        animation-delay: calc(var(--i,0) * 0.06s);
        transition: transform .22s ease, box-shadow .22s ease, border-color .18s ease;
    }
    .card:hover{
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 10px 28px rgba(2,6,23,0.18);
        border-color: rgba(0,0,0,0.08);
    }
    .card img{
       transition: transform .36s ease;
    }
    .card:hover img{
        transform: scale(1.06);
    }
    @keyframes cardIn{
        from{ opacity:0; transform: translateY(10px) scale(.995); }
        to  { opacity:1; transform: translateY(0) scale(1); }
    }

    /* placeholder pequeño para fallback */
    img.fallback {
        background: linear-gradient(90deg,#eee,#f7f7f7);
    }
</style>
</head>
<body class="<?php echo ($clase_tema); ?>">
<header>
    <h1>Dragon Ball Z — Guerreros</h1>
    <span class="muted">Tema actual: <strong><?php echo ($tema); ?></strong></span>
</header>

<!-- Formulario GET: buscar / filtrar / tema -->
<form class="panel" method="get" action="">
    <div>
        <label for="buscar">Buscar por nombre</label>
        <input type="text" id="buscar" name="buscar" value="<?php echo ($buscar); ?>" placeholder="Ej: Goku" />
    </div>
    <div>
        <label for="raza">Filtrar por raza</label>
        <select id="raza" name="raza">
            <option value="">Todas</option>
            <?php foreach($razas as $r): ?>
                <option value="<?php echo ($r); ?>" <?php echo $filtro_raza===$r?'selected':''; ?>>
                    <?php echo ($r); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label for="tema">Tema</label>
        <select id="tema" name="tema">
            <option value="claro"  <?php echo $tema==='claro'?'selected':''; ?>>claro</option>
            <option value="oscuro" <?php echo $tema==='oscuro'?'selected':''; ?>>oscuro</option>
        </select>
    </div>
    <div>
        <label>&nbsp;</label>
        <input type="submit" value="Aplicar" />
    </div>
</form>

<!-- Listado de tarjetas -->
<section class="grid">
<?php if(empty($personajes)): ?>
    <p class="muted">No se encontraron personajes con esos criterios.</p>
<?php else: ?>
    <?php foreach($personajes as $slug => $p): ?>
    <article class="card">
        <img src="<?php echo ($p['imagen']); ?>" alt="<?php echo ($p['nombre']); ?>" />
        <div class="box">
            <h3><?php echo ($p['nombre']); ?></h3>
            <p class="muted"><?php echo ($p['descripcion']); ?></p>
            <p><span class="tag"><?php echo ($p['raza']); ?></span></p>
            <p class="poder"><strong>Poder:</strong> <?php echo ((string)$p['poder']); ?></p>
        </div>
    </article>
    <?php endforeach; ?>
<?php endif; ?>
</section>

<!-- Formulario POST: sugerir nuevo ítem -->
<section class="panel" style="margin-top:1.25rem;">
    <div>
        <h2 style="margin:.25rem 0;">Sugerir un nuevo personaje</h2>
        <p class="muted" style="margin:0;">(Se muestran los datos enviados como confirmación; no se guarda en base de datos.)</p>
    </div>
    <form method="post" action="" style="display:flex; gap:1rem; flex-wrap:wrap;">
        <div>
            <label for="nombre_sugerido">Nombre</label>
            <input type="text" id="nombre_sugerido" name="nombre_sugerido" required />
        </div>
        <div style="min-width:280px; flex:1;">
            <label for="desc_sugerida">Descripción</label>
            <input type="text" id="desc_sugerida" name="desc_sugerida" required />
        </div>
        <div>
            <label>&nbsp;</label>
            <input type="submit" value="Enviar sugerencia" />
        </div>
    </form>
</section>

<?php if($error_post): ?>
    <div class="msg err"><?php echo ($error_post); ?></div>
<?php endif; ?>
<?php if($mensaje_post): ?>
    <div class="msg ok"><?php echo ($mensaje_post); ?></div>
<?php endif; ?>

<footer>
    <small>Trabajo práctico — Programación Web II.</small>
</footer>
</body>
</html>

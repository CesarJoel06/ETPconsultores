# ETP CONSULTORES — Sitio web (HTML + CSS + JS)

Proyecto estático listo para usar. Incluye:
- `index.html` con CSS embebido y JS ligero.
- `assets/logo.png` (logo adjunto).
- `assets/images/*.webp` (imágenes optimizadas para la web).
- Diseño responsive (breakpoints 980px / 768px / 480px).
- Menú móvil tipo drawer con animación slide-in.
- Navegación activa por sección, scroll reveal y contador animado.
- Botón “volver arriba”.

## Cómo ejecutar (local)
1) Descomprime el ZIP.
2) Abre `index.html` en tu navegador.

> Recomendado: si usas VS Code, instala “Live Server” y abre con servidor local.

## Personalización rápida
- Logo: reemplaza `assets/logo.png` (mantén el mismo nombre).
- Colores: edita variables CSS en `:root` dentro de `index.html`.
- Textos: busca las secciones por comentarios `SECCIÓN X`.

## Formulario de contacto
Actualmente es **demostrativo**: valida campos y muestra un mensaje, pero **no envía** a un servidor.
Para envío real, tienes dos opciones típicas:
1) Conectar un endpoint propio (API) y enviar con `fetch`.
2) Usar un servicio de formularios (si lo apruebas para producción).

Si deseas, puedo adaptarlo a tu backend (Node/Spring) y dejarlo 100% operativo.

## Notas
- El mapa se carga desde Google Maps (iframe). Puedes cambiar/eliminar el bloque “Mapa” si necesitas una web 100% offline.
- El favicon usa el mismo `assets/logo.png`.

© 2026 ETP Consultores (contenido de ejemplo).
## Envío del formulario por correo (funcional)

Este proyecto incluye un handler PHP: `server/send.php`.

1. Sube la carpeta `etp-consultores/` a un hosting con **PHP**.
2. Edita `server/send.php` y cambia:
   - `$TO = 'contacto@etpconsultores.com';` por el **destinatario real**.
3. Asegúrate de que el hosting tenga habilitado `mail()` (o un MTA configurado).

Si tu hosting no soporta `mail()`, el formulario hará *fallback* a `mailto:` (abrirá el cliente de correo del usuario) y también te deja continuar por WhatsApp.

## WhatsApp y redes sociales (links listos para reemplazar)

En `index.html`, dentro del `<script>`, edita:

- `CONFIG.whatsappPhone` (formato: **519XXXXXXXX** sin + ni espacios)
- `CONFIG.social.linkedin` y `CONFIG.social.facebook`

Los CTAs de **Cotizar por WhatsApp** y el botón flotante se generan automáticamente con esos valores.

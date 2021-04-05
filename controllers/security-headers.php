<?php

//Indicamos que solo aceptamos metodos POST y GET
header("Access-Control-Allow-Methods: GET, POST");

//Esta cabecera permite a los sitios optar por informar y/o hacer cumplir los requisitos de Transparencia de certificados, para evitar que el uso de certificados emitidos incorrectamente para ese sitio pase desapercibido.
header("Expect-CT: enforce, max-age=86400");

//Por lo general, este encabezado muestra información adicional del servidor.
//Por motivos de seguridad, la ocultamos reemplazandola por un valor dado.
header("X-Powered-By: WinterAO WebMasters");

//El encabezado de respuesta HTTP X-Frame-Options puede ser usado para indicar si debería permitírsele a un navegador renderizar una página en un <frame>, <iframe> o <object> .
//Las páginas webs pueden usarlo para evitar ataques de clickjacking , asegurándose que su contenido no es embebido en otros sitios.
header("X-Frame-Options: SAMEORIGIN");

//HTTP Strict-Transport-Security (a menudo abreviado como HSTS) es una característica de seguridad que permite a un sitio web indicar a los navegadores que sólo se debe comunicar con HTTPS en lugar de usar HTTP.
header("Strict-Transport-Security: max-age=31536000; includeSubDomains");

//Es un marcador utilizado por el servidor para indicar que los tipos MIME anunciados en los encabezados Content-Type no se deben cambiar ni seguir. Esto permite desactivar el MIME type sniffing, o, en otras palabras, es una manera de decir que los webmasters sabían lo que estaban haciendo.

//Este encabezado fue introducido por Microsoft en IE 8 para que los webmasters bloquearan el rastreo de contenido, pudiendo transformar tipos MIME no ejecutables en tipos MIME ejecutables. Desde entonces, otros navegadores lo han introducido, incluso con  algoritmos de detección MIME menos agresivos.
header("X-Content-Type-Options: nosniff");

//La cabecera Referrer-Policy de HTTP determina qué datos de referente, de entre los que se envían con la cabecera Referer, deben incluirse con las solicitudes realizadas.
header("Referrer-Policy: no-referrer-when-downgrade");

//The HTTP Feature-Policy header provides a mechanism to allow and deny the use of browser features in its own frame, and in content within any <iframe> elements in the document. [Experimental]
$header_args = "accelerometer 'none'; ";
$header_args .= "ambient-light-sensor 'none'; ";
$header_args .= "autoplay 'none'; ";
$header_args .= "camera 'none'; ";
$header_args .= "encrypted-media 'none'; ";
$header_args .= "fullscreen 'self'; ";
$header_args .= "geolocation 'none'; ";
$header_args .= "gyroscope 'none'; ";
$header_args .= "magnetometer 'none'; ";
$header_args .= "microphone 'none'; ";
$header_args .= "midi 'none'; ";
$header_args .= "payment 'none'; ";
$header_args .= "sync-xhr 'self'; ";
$header_args .= "usb 'none'; ";
$header_args .= "picture-in-picture 'self' ";
header("Feature-Policy: " . $header_args);

//La cabecera HTTP Content-Security-Policy  en la respuesta permite a los administradores de un sitio web controlar los recursos que el User-Agent puede cargar a una pagina. Con algunas (Poquísimas) excepciones, las políticas implican principalmente especificar el servidor de origen la protección de puntos finales del script. Esto ayuda a protegerse contra ataques Cross-site scripting (XSS).
$header_args = "default-src 'none'; ";
$header_args = "connect-src 'self'; ";
$header_args .= "script-src 'self' cdnjs.cloudflare.com www.gstatic.com www.google.com code.jquery.com cdn.jsdelivr.net stackpath.bootstrapcdn.com; ";
$header_args .= "style-src 'self' fonts.googleapis.com stackpath.bootstrapcdn.com; ";
$header_args .= "img-src 'self' i.ytimg.com; ";
$header_args .= "font-src 'self' fonts.googleapis.com fonts.gstatic.com;";
$header_args .= "frame-src 'self' www.youtube.com www.google.com; ";
$header_args .= "upgrade-insecure-requests; ";
$header_args .= "block-all-mixed-content; ";
header("Content-Security-Policy: " . $header_args);
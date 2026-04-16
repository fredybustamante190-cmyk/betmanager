<h2> BetManager - Notificación</h2>

<p>{{ $mensaje }}</p>

<hr>

<p><strong>Apuesta:</strong> {{ $apuesta->nombre_apuesta }}</p>
<p><strong>Tipo:</strong> {{ $apuesta->tipo_apuesta }}</p>
<p><strong>Monto:</strong> $ {{ number_format($apuesta->monto, 2) }}</p>
<p><strong>Fecha:</strong> {{ $apuesta->fecha_apuesta }}</p>
<p><strong>Estado:</strong> {{ ucfirst($apuesta->estado) }}</p>

<hr>

<p>Gracias por usar BetManager 💰</p>
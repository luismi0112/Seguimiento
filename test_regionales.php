<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$Regionales = App\Models\Regionales::all();
echo "Total de Regionales: " . count($Regionales) . "\n";
foreach ($Regionales as $regional) {
    echo "ID: " . $regional->id . " | Denominacion: " . $regional->Denominacion . "\n";
}

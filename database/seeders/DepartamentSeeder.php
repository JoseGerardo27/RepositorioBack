<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $d1 = Departamento::create([
            'name' => 'ADMINISTRACION',
            'nomenclature' => 'AD',
        ]);
        $d2 = Departamento::create([
            'name' => 'ALMACEN',
            'nomenclature' => 'AL',
        ]);
        $d3 = Departamento::create([
            'name' => 'CALIDAD',
            'nomenclature' => 'CA',
        ]);
        $d4 = Departamento::create([
            'name' => 'COMPRAS',
            'nomenclature' => 'CO',
        ]);
        $d5 = Departamento::create([
            'name' => 'CONTABILIDAD',
            'nomenclature' => 'CT',
        ]);
        $d6 = Departamento::create([
            'name' => 'DESARROLLO ORGANIZACIONAL',
            'nomenclature' => 'DO',
        ]);
        $d7 = Departamento::create([
            'name' => 'DIRECCION',
            'nomenclature' => 'DC',
        ]);
        $d8 = Departamento::create([
            'name' => 'FACILITY',
            'nomenclature' => 'FC',
        ]);
        $d9 = Departamento::create([
            'name' => 'FACTURACION',
            'nomenclature' => 'FT',
        ]);
        $d10 = Departamento::create([
            'name' => 'GERENCIA',
            'nomenclature' => 'GE',
        ]);

        $d11 = Departamento::create([
            'name' => 'GESTION DE PROYECTOS',
            'nomenclature' => 'PY',
        ]);

        $d12 = Departamento::create([
            'name' => 'INGENIERIA',
            'nomenclature' => 'IN',
        ]);

        $d13 = Departamento::create([
            'name' => 'INTENDENCIA',
            'nomenclature' => 'ID',
        ]);

        $d14 = Departamento::create([
            'name' => 'LEGAL',
            'nomenclature' => 'LG',
        ]);

        $d15 = Departamento::create([
            'name' => 'LOGISTICA',
            'nomenclature' => 'LO',
        ]);

        $d16 = Departamento::create([
            'name' => 'MERCADOTECNIA',
            'nomenclature' => 'MK',
        ]);

        $d17 = Departamento::create([
            'name' => 'OPERACIONES',
            'nomenclature' => 'OP',
        ]);

        $d18 = Departamento::create([
            'name' => 'PRODUCCION',
            'nomenclature' => 'PR',
        ]);

        $d19 = Departamento::create([
            'name' => 'RECURSOS HUMANOS',
            'nomenclature' => 'RH',
        ]);

        $d20 = Departamento::create([
            'name' => 'SEGURIDAD E HIGIENE',
            'nomenclature' => 'SH',
        ]);

        $d21 = Departamento::create([
            'name' => 'SEGURIDAD PATRIMONIAL',
            'nomenclature' => 'SP',
        ]);

        $d22 = Departamento::create([
            'name' => 'SISTEMAS',
            'nomenclature' => 'SM',
        ]);

        $d23 = Departamento::create([
            'name' => 'SOLUCIONES CONVERGENTES',
            'nomenclature' => 'SC',
        ]);

        $d24 = Departamento::create([
            'name' => 'SOPORTE TECNICO',
            'nomenclature' => 'ST',
        ]);

        $d25 = Departamento::create([
            'name' => 'VENTAS CORPORATIVAS',
            'nomenclature' => 'VC',
        ]);

        $d26 = Departamento::create([
            'name' => 'VENTAS RETAIL',
            'nomenclature' => 'VR',
        ]);

        $d27 = Departamento::create([
            'name' => 'CONTROL DE INVENTARIOS',
            'nomenclature' => 'CI',
        ]);

        $d28 = Departamento::create([
            'name' => 'CREDITO Y COBRANZA',
            'nomenclature' => 'CC',
        ]);

        $d29 = Departamento::create([
            'name' => 'CUENTAS POR PAGAR',
            'nomenclature' => 'CP',
        ]);

        $d30 = Departamento::create([
            'name' => 'MANTENIMIENTO',
            'nomenclature' => 'MT',
        ]);

        $d31 = Departamento::create([
            'name' => 'TESORERIA',
            'nomenclature' => 'TR',
        ]);

        $d32 = Departamento::create([
            'name' => 'VENTAS MANOFACTURA',
            'nomenclature' => 'VM',
        ]);
        $d32 = Departamento::create([
            'name' => 'PENDIENTE',
            'nomenclature' => 'PS',
        ]);
    }
}

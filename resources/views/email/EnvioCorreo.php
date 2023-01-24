<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- {{--   <link rel="stylesheet" href={{ URL::to("/css/reset_email.css") }} alt=''/> --}} -->
    <style>
        .girl img{
            width: 150px;
            height: 100px;
        }
        .botons {
            background: none;
            border: 1px solid #3498db;
            padding: 10px 40px;
            color: #3498db;
            font-size: 20px;
            cursor: pointer;
            margin: 10px;
            transition: 0.8s;
            position: relative;
            overflow: hidden;
            border-radius: 25px;
            width: 400px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .form-register {
            width: 600px;
            background: #24303c;
            padding: 40px;
            margin: auto;
            margin-top: 50px;

            text-align: justify;
        }
        .form-register p{
            font-family: 'calibri';
            color: black;
            /* text-align: center; */
        }

    </style>
</head>
<body>

    <form class="form-register" >
            <section >
                <h1 style="text-align:center;" color>BIENVENIDO</h1>
                <center>
                    <div>
                        <h3 style="text-align:center;">Su usuario ha sido creado con éxito</h3>
                        <p></p>
                        <p><b>Para dudas o aclaraciones favor de consultar al departamento de Sistemas.</b></p>
                    </div>
                    <a class="botons btn1"  href="http://app.gpocsi.mx">Continuar</a>
                </center>
            </section>
        </form>

</body>
<style>



    .form-register h1 {
        font-size: 33px;
        margin-bottom: 20px;
        text-align: center;
    }

    .controls {
        width: 100%;
        background: #24303c;
        padding: 10px;
        border-radius: 4px;
        margin-bottom: 16px;
        border: 1px solid #1f53c5;
        font-family: 'calibri';
        font-size: 18;
    }

    .controls p {
        height: 150px;
        text-align: justify;
        font-size: 18px;
    }





    .btn1 {
        color: #3498db;
    }


    .botons::before {
        content: "";
        position: absolute;
        left: 0;
        width: 100%;
        height: 0%;
        background: #3498db;
        z-index: -1;
        transition: 0.8s;
    }

    .btn1::before {
        top: 0;
        border-radius: 0 0 50% 50%;
    }

    .btn1:hover::before {
        height: 180%;
    }
</style>
</html>

@extends('./layout/plantilla')
@section('titulo', 'Constructora')
@section('seccion')
    <div class="container mt-5">
        <h1>Inicio</h1>
        <p>Bienvenidos a la página de la constructora</p>
        <p>Nos especializamos en la construcción de edificios residenciales y comerciales de alta calidad. Nuestro equipo de profesionales está dedicado a ofrecer los mejores servicios en el sector de la construcción.</p>
        <h2>Nuestros Proyectos</h2>
        <div class="row">
            <div class="col-md-4">
                <img src="https://via.placeholder.com/300" alt="Proyecto 1" class="img-fluid">
                <h3>Proyecto 1</h3>
                <p>Descripción del proyecto 1. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div class="col-md-4">
                <img src="https://via.placeholder.com/300" alt="Proyecto 2" class="img-fluid">
                <h3>Proyecto 2</h3>
                <p>Descripción del proyecto 2. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <div class="col-md-4">
                <img src="https://via.placeholder.com/300" alt="Proyecto 3" class="img-fluid">
                <h3>Proyecto 3</h3>
                <p>Descripción del proyecto 3. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
        </div>
        <h2>Nuestros Servicios</h2>
        <ul>
            <li>Construcción de edificios residenciales</li>
            <li>Construcción de edificios comerciales</li>
            <li>Renovación y remodelación</li>
            <li>Consultoría y gestión de proyectos</li>
        </ul>
        <h2>Nuestro Equipo</h2>
        <div class="row">
            <div class="col-md-3">
                <img src="https://via.placeholder.com/150" alt="Miembro 1" class="img-fluid rounded-circle">
                <h4>Miembro 1</h4>
                <p>Ingeniero Civil</p>
            </div>
            <div class="col-md-3">
                <img src="https://via.placeholder.com/150" alt="Miembro 2" class="img-fluid rounded-circle">
                <h4>Miembro 2</h4>
                <p>Arquitecto</p>
            </div>
            <div class="col-md-3">
                <img src="https://via.placeholder.com/150" alt="Miembro 3" class="img-fluid rounded-circle">
                <h4>Miembro 3</h4>
                <p>Gerente de Proyecto</p>
            </div>
            <div class="col-md-3">
                <img src="https://via.placeholder.com/150" alt="Miembro 4" class="img-fluid rounded-circle">
                <h4>Miembro 4</h4>
                <p>Diseñador de Interiores</p>
            </div>
        </div>
        <h2>Testimonios</h2>
        <div class="testimonial">
            <p>"La constructora hizo un trabajo excelente en nuestro edificio comercial. Altamente recomendados!" - Cliente 1</p>
        </div>
        <div class="testimonial">
            <p>"Estamos muy satisfechos con la calidad y profesionalismo del equipo. Nuestro hogar quedó hermoso." - Cliente 2</p>
        </div>
        <div class="testimonial">
            <p>"Gran atención al detalle y cumplimiento de plazos. Definitivamente volveremos a trabajar con ellos." - Cliente 3</p>
        </div>
    </div>
@endsection
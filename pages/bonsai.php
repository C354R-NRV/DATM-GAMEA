<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarjetas Virtuales - Soluciones Informáticas</title>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #30ada3;
            --primary-light: #14b8a6;
            --dark: #1e293b;
            --gray-light: #f1f5f9;
            --gray-text: #64748b;
            --border: #e2e8f0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: var(--dark);
            background-color: #ffffff;
        }

        /* Header */
        header {
            background: linear-gradient(135deg, var(--primary) 0%, #030c0bff 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        header p {
            font-size: 1.1rem;
            opacity: 0.95;
            margin-bottom: 20px;
        }

        .contact-header {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.15);
            padding: 10px 20px;
            border-radius: 8px;
            backdrop-filter: blur(10px);
        }

        .contact-item strong {
            font-weight: 600;
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Sección de Beneficios */
        .section {
            margin-bottom: 80px;
        }

        .section-title {
            font-size: 2rem;
            margin-bottom: 40px;
            color: var(--dark);
            text-align: center;
            position: relative;
            padding-bottom: 20px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: var(--primary-light);
            border-radius: 2px;
        }

        /* Cards de Beneficios */
        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-bottom: 60px;
        }

        .benefit-card {
            background: var(--gray-light);
            padding: 30px;
            border-radius: 12px;
            border-left: 4px solid var(--primary-light);
            transition: all 0.3s ease;
        }

        .benefit-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(20, 184, 166, 0.1);
        }

        .benefit-card h3 {
            color: var(--primary);
            margin-bottom: 15px;
            font-size: 1.2rem;
        }

        .benefit-card p {
            color: var(--gray-text);
            margin-bottom: 10px;
            font-size: 0.95rem;
        }

        .benefit-highlight {
            color: var(--primary-light);
            font-weight: 600;
        }

        /* Sección Para Quién */
        .audience-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-bottom: 60px;
        }

        .audience-card {
            background: white;
            border: 2px solid var(--border);
            padding: 35px;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .audience-card:hover {
            border-color: var(--primary-light);
            box-shadow: 0 15px 35px rgba(20, 184, 166, 0.08);
        }

        .audience-card h3 {
            color: var(--primary);
            margin-bottom: 20px;
            font-size: 1.3rem;
        }

        .audience-card ul {
            list-style: none;
        }

        .audience-card li {
            padding: 8px 0;
            color: var(--gray-text);
            padding-left: 25px;
            position: relative;
        }

        .audience-card li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--primary-light);
            font-weight: bold;
        }

        /* CTA */
        .cta-section {
            background: linear-gradient(135deg, var(--primary) 0%, #0d5f5a 100%);
            color: white;
            padding: 50px;
            border-radius: 12px;
            text-align: center;
            margin-bottom: 60px;
        }

        .cta-section a {
            color: white;
            text-decoration: none;
            cursor: pointer;
            font-size: 3vh;
        }

        .cta-section a:hover {

            text-decoration: underline;
            font-size: 3.1vh;
        }

        .cta-section h2 {
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        /* Tabla de Precios */
        .pricing-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
        }

        .pricing-table thead {
            background: var(--primary);
            color: white;
        }

        .pricing-table th {
            padding: 20px;
            text-align: left;
            font-weight: 600;
        }

        .pricing-table td {
            padding: 18px 20px;
            border-bottom: 1px solid var(--border);
            color: var(--gray-text);
        }

        .pricing-table tbody tr:hover {
            background: var(--gray-light);
        }

        .pricing-table tbody tr:last-child td {
            border-bottom: none;
        }

        .plan-name {
            color: var(--primary);
            font-weight: 600;
        }

        .price {
            color: var(--primary-light);
            font-size: 1.2rem;
            font-weight: 700;
        }

        /* Footer */
        footer {
            background: var(--dark);
            color: white;
            text-align: center;
            padding: 30px 20px;
            margin-top: 60px;
            font-size: 0.95rem;
        }

        footer p {
            opacity: 0.8;
        }

        /* Responsive */
        @media (max-width: 768px) {
            header h1 {
                font-size: 1.8rem;
            }

            .contact-header {
                flex-direction: column;
                align-items: center;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .cta-section {
                padding: 30px;
            }

            .cta-section h2 {
                font-size: 1.3rem;
            }

            .benefits-grid,
            .audience-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header style="
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
">
        <div style="
        position: absolute;
        right: 3vh;
        top: 5vh;
    ">
            <img src="../img/logob.png" style="height: 11vh; width:11vh;" />
        </div>

        <h1>BonCard</h1>
        <h3>Tarjetas Virtuales</h3>
        <p>Soluciones Informáticas con Inteligencia Artifical</p>
    </header>

    <div class="container">
        <!-- Beneficios -->
        <section class="section">
            <h2 class="section-title">Beneficios Clave</h2>
            <div class="benefits-grid">
                <div class="benefit-card">
                    <h3>🌱 Sostenibles y Ecológicas</h3>
                    <p>Eliminan el uso de papel, reduciendo el impacto ambiental de tu negocio.</p>
                    <p><span class="benefit-highlight">✓ Contribuye a un futuro más verde.</span></p>
                </div>
                <div class="benefit-card">
                    <h3>⚡ Interactivas y Dinámicas</h3>
                    <p>Links directos a tus redes sociales, email, WhatsApp, sitio web y catálogos.</p>
                    <p><span class="benefit-highlight">✓ Aumenta la interacción con tus clientes.</span></p>
                </div>
                <div class="benefit-card">
                    <h3>🔄 Siempre Actualizadas</h3>
                    <p>Modifica datos y enlaces en tiempo real, sin reimpresiones.</p>
                    <p><span class="benefit-highlight">✓ Mantén tu información al día.</span></p>
                </div>
                <div class="benefit-card">
                    <h3>💼 Imagen Profesional</h3>
                    <p>Refuerza tu identidad corporativa y presencia digital.</p>
                    <p><span class="benefit-highlight">✓ Causa una impresión duradera.</span></p>
                </div>
            </div>
        </section>

        <!-- Para Quién -->
        <section class="section">
            <h2 class="section-title">¿Para Quién Son Ideales?</h2>
            <div class="audience-grid">
                <div class="audience-card">
                    <h3>🏢 Empresas y Corporaciones</h3>
                    <ul>
                        <li>Centralización de tarjetas digitales</li>
                        <li>Imagen uniforme</li>
                        <li>Gestión y actualización masiva sencilla</li>
                    </ul>
                </div>
                <div class="audience-card">
                    <h3>👤 Profesionales Independientes</h3>
                    <ul>
                        <li>Identidad digital moderna</li>
                        <li>Mayor alcance y presencia online</li>
                    </ul>
                </div>
                <div class="audience-card">
                    <h3>🤝 Instituciones y ONGs</h3>
                    <ul>
                        <li>Alternativa sostenible alineada con responsabilidad ambiental</li>
                        <li>Digitalización eficiente</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="cta-section">
            <h2>¿Y tú? ¿Qué esperas para solicitar tu tarjeta virtual?</h2>
            <a href="https://api.whatsapp.com/send?phone=59178400889&text=Hola%20DATM%20tengo%20la%20siguiente%20consulta">Contáctanos! <b><i class="fa-whatsapp"></i> +591 78400889</b></a>
        </section>

        <!-- Precios -->
        <section class="section">
            <h2 class="section-title">Planes y Precios</h2>
            <table class="pricing-table">
                <thead>
                    <tr>
                        <th>Plan</th>
                        <th>Usuarios</th>
                        <th>Precio Mensual</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="plan-name">Start</span></td>
                        <td>1 - 10</td>
                        <td><span class="price">Bs. 20</span> / Usuario / Mes</td>
                    </tr>
                    <tr>
                        <td><span class="plan-name">Pro</span></td>
                        <td>11 - 50</td>
                        <td><span class="price">Bs. 18</span> / Usuario / Mes</td>
                    </tr>
                    <tr>
                        <td><span class="plan-name">Business</span></td>
                        <td>51 - 100</td>
                        <td><span class="price">Bs. 16</span> / Usuario / Mes</td>
                    </tr>
                    <tr>
                        <td><span class="plan-name">Enterprise</span></td>
                        <td>101 ++</td>
                        <td><span class="price">Bs. 14</span> / Usuario / Mes</td>
                    </tr>
                </tbody>
            </table>
            <p style="text-align: center; margin-top: 20px; color: var(--gray-text);">
                <strong>Nota:</strong> Precios negociables según volumen o requerimientos. Descuentos por subscripción anual.
            </p>
        </section>
    </div>

    <footer>
        <p>&copy; 2025 Bolivia Inc. - Soluciones Informáticas. Todos los derechos reservados.</p>
    </footer>
</body>

</html>
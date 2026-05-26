# DATM-Inteligente 🚀
> Sistema Integrado de Gestión y Modernización Tributaria para la Dirección de Administración Tributaria Municipal (DATM) del Gobierno Autónomo Municipal de El Alto (GAMEA).

[![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)](https://github.com/)
[![Database](https://img.shields.io/badge/Database-PostgreSQL%2016-blue)](https://www.postgresql.org/)
[![Protocol](https://img.shields.io/badge/Protocol-SOAP%20%2F%20REST-orange)](https://en.wikipedia.org/wiki/SOAP)
[![Platform Compliance](https://img.shields.io/badge/Platform-Android%2012%2B%20%7C%20iOS%20%7C%20Desktop-green)](#requisitos-del-sistema)

---

## 📌 Descripción General

**DATM-Inteligente** es una plataforma web y móvil diseñada exclusivamente para optimizar, desburocratizar y sistematizar las actividades de fiscalización, recaudación y control de tributos (inmuebles, vehículos y actividades económicas) en la ciudad de El Alto. 

El sistema destaca por centralizar servicios dispersos, integrar automatizaciones con Inteligencia Artificial para la redacción de documentos de control formal (CITES), interactuar de manera segura en tiempo real con la ASFI y proveer un potente módulo geoespacial para auditorías en campo.

---

## 🛠️ Características Principales & Módulos

### 1. 🔑 Gestión de Usuarios e Infraestructura de Permisos
* Módulo restringido para administración exclusiva del Área de Sistemas.
* Control de bajas lógicas y auditoría detallada de acciones por operador.

### 2. 🤖 Asistente de CITES Automatizado con IA
* Sistematización dinámica del formato de CITE por unidad organizativa (DIR, GA, SIS, UAJ-CC, UFYR, UICT).
* **Asistente de Redacción Integrado:** Incorpora modelos de IA para la generación automatizada del cuerpo de notas institucionales, informes técnicos y providencias en segundos.
* Control de colisiones: Mecanismo de reutilización automática de numeración de CITE si la última baja fue lógica dentro del día.

### 3. 🏦 Subsistema SIREFO (Conectividad ASFI)
* **Reducción de Tiempos Críticos:** Reduce los tiempos de tramitación para retenciones de cuentas bancarias y suspensiones **de 30 días a solo 24 horas (1 día)**.
* **Interoperabilidad:** Consumo de servicios Web basados en el protocolo **SOAP** a través de un canal seguro **VPN** configurado de extremo a extremo.
* Carga dinámica de ítems para bienes tributarios combinados (Inmuebles, Vehículos, Actividades Económicas).

### 4. 🗺️ Subsistema Geoespacial y Fiscalización (Móvil/Campo)
* Georreferenciación en tiempo real para brigadas operativas en campo mediante la API de OpenStreetMap.
* **Optimización de Imagenes (Client-side):** Compresión inteligente de imágenes directamente en el navegador del dispositivo móvil del fiscalizador, reduciendo capturas nativas de aproximadamente 8MB a solo 200KB antes de la subida, garantizando un rendimiento óptimo de almacenamiento y ancho de banda celular.
* Cuadro de mando integral (Dashboard) con métricas en tiempo real sobre puntos visitados, procesados, consolidados y en desacato.

### 5. ⏳ Módulo Histórico SIMAT/SIIM (Ingeniería Inversa)
* Abstracción y rescate del sistema legacy desarrollado en **FoxPro 9 (sistema CARTAS)** utilizado en la ventanilla de certificaciones.
* Proceso de ingeniería inversa completo y migración de datos relacionales históricos hacia la infraestructura centralizada en **PostgreSQL v16**.

---

## 💻 Arquitectura y Endpoints Clave

El backend del sistema gestiona la persistencia y la comunicación externa de forma segura:

* **API Gateway Institucional:** Acceso y procesamiento centralizado mediante endpoints institucionales seguros.
* **Servicio Externo Seguro:** Canal VPN directo hacia el Endpoint SOAP de ASFI.
* **Repositorio de Archivos Escaneados:** Almacenamiento optimizado y estructurado por tipo de bien tributario (Inmuebles, Vehículos, Actividades Económicas).
* **Criptografía y Validación:** Los documentos impresos emitidos generan firmas hash únicas basadas en la base de datos y códigos QR dinámicos para la verificación del contribuyente en la plataforma oficial.

---

## 📋 Requisitos del Sistema

### Entorno de Cliente (Funcionario)
* **Navegadores Soportados:** Google Chrome (Recomendado), Mozilla Firefox, Microsoft Edge.
* **Resolución Mínima de Pantalla:** 1024x768 píxeles.
* **Dispositivos Móviles (Brigadas de Campo):** Android 12 o superior con permisos de GPS activos, cámara frontal funcional y Google Chrome Mobile instalado.

---

## 🔒 Licencia y Restricciones

⚠️ **PROPIEDAD INTELECTUAL:** Queda estrictamente prohibida la reproducción, distribución, comunicación pública y/o transformación, total o parcial, de los componentes informáticos, código fuente o documentación de este sistema sin el previo consentimiento expreso y por escrito de la **Dirección de Administración Tributaria Municipal (DATM)** perteneciente al **Government Autónomo Municipal de El Alto**.

---
👨‍💻 *Desarrollado y mantenido por Cesar Nilton Rojas Valero Área de Sistemas - DATM 05/2026.*
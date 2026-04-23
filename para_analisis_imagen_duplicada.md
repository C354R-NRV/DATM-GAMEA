# consulta sql
SELECT  id, numero_inmueble, codigo_catastral, latitud, longitud, imagen_principal, imagen_adicional, fecha_apersonamiento , clasificacion, ESTADO_, no_formulario
FROM uf_predial
WHERE clasificacion = 'A'
  AND estado_ = true
  AND (imagen_principal, imagen_adicional) IN (
    SELECT imagen_principal, imagen_adicional
    FROM uf_predial
    WHERE clasificacion = 'A'
      AND estado_ = true
      and imagen_principal != ''
    GROUP BY imagen_principal, imagen_adicional
    HAVING COUNT(*) > 1
) order by imagen_principal, imagen_adicional

limit 6;
# resultado de consulta

id	numero_inmueble	codigo_catastral	latitud	longitud	imagen_principal	imagen_adicional	fecha_apersonamiento	clasificacion	estado_	no_formulario
690	INM-A338	5-132-13	-16.4831272	-68.1761017	inmueble_1751645686_principal.jpg		2025-07-04 12:14:46	A	t	23963
689	INM-A337	05-109-2	-16.4794981	-68.1786337	inmueble_1751645686_principal.jpg		2025-07-04 12:14:46	A	t	0
699	1510170100	05-0116-011	-16.4812677	-68.1769171	inmueble_1751646022_principal.jpg		2025-07-04 12:20:22	A	t	23899
698	1510140337	05-130-026	-16.4821499	-68.1790012	inmueble_1751646022_principal.jpg		2025-07-04 12:20:22	A	t	24139
1215	1510134853	20-012-004	-16.5155469	-68.2135534	inmueble_1752247090_principal.jpg	inmueble_1752247090_adicional_0.jpg	2025-07-11 11:18:10	A	t	24407
1214	INM-618-551230	20-25-14	-16.5171644	-68.2159084	inmueble_1752247090_principal.jpg	inmueble_1752247090_adicional_0.jpg	2025-07-11 11:18:10	A	t	24368
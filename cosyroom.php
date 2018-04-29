<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Salon cosy de Work'n Share</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
		<style>
		body {
			background-color: #000;
			margin: 0px;
			overflow: hidden;
		}
		</style>
	</head>

	<body>
		<script src="assets/three.js/three.js"></script>
		<script src="assets/three.js/OrbitControls.js"></script>

		<script>
		var mesh, renderer, scene, camera, controls;

		init();
		animate();

		function init() {
		    renderer = new THREE.WebGLRenderer();
		    renderer.setSize( window.innerWidth, window.innerHeight );
		    renderer.setClearColor( 0xe80bfff );
		    document.body.appendChild( renderer.domElement );
				window.addEventListener( 'resize', onWindowResize, false );

		    scene = new THREE.Scene();

		    camera = new THREE.PerspectiveCamera( 40, window.innerWidth / window.innerHeight, 1, 1000 );
		    camera.position.set( 0, 30, 50 );
		    scene.add( camera );

		    controls = new THREE.OrbitControls( camera );
		    controls.enableZoom = true;
		    controls.enablePan = false;
		    controls.maxPolarAngle = Math.PI / 2;

				// Lumière ambiente
		    scene.add( new THREE.AmbientLight( 0xd9d9d9 ) );

				// Lumière pointage caméra
		    var light = new THREE.PointLight( 0xffffe6, 0.1 );
		    camera.add( light );

		    // Mur du batiment
		    var geometry = new THREE.BoxGeometry( 40, 10, 40 );

		    var material1 = new THREE.MeshPhongMaterial( {
		        color: 0xffffff,
		        transparent: true,
		        opacity: 0.1
		    } );

		    mesh = new THREE.Mesh( geometry, material1 );
		    scene.add( mesh );

		    // Mur du batiment
		    var material2 = new THREE.MeshPhongMaterial( {
		        color: 0xf2f2f2,
		        transparent: false,
		        side: THREE.BackSide
		    } );

		    mesh = new THREE.Mesh( geometry, material2 );
		    scene.add( mesh );

        var sofa1 = new THREE.ObjectLoader();
        sofa1.load("assets/three.js/sofa.json", function ( sofa ) {
          sofa.position.x = -17.8;
          sofa.position.y = -4.5;
          sofa.position.z = -18;
          sofa.rotation.y = 3.15;
          sofa.scale.set(0.3,0.3,0.3);
          scene.add( sofa );
        } );

        var sofa2 = new THREE.ObjectLoader();
        sofa2.load("assets/three.js/sofa.json", function ( sofa ) {
          sofa.position.x = 18;
          sofa.position.y = -4.5;
          sofa.position.z = -18;
          sofa.rotation.y = 1.55;
          sofa.scale.set(0.3,0.3,0.3);
          scene.add( sofa );
        } );

        var sofa3 = new THREE.ObjectLoader();
        sofa3.load("assets/three.js/sofa2.json", function ( sofa2 ) {
          sofa2.position.x = 18;
          sofa2.position.y = -4.2;
          sofa2.position.z = 0;
          sofa2.rotation.y = 1.55;
          sofa2.scale.set(0.1,0.1,0.1);
          scene.add( sofa2 );
        } );

        var sofa4 = new THREE.ObjectLoader();
        sofa4.load("assets/three.js/sofa2.json", function ( sofa2 ) {
          sofa2.position.x = 14;
          sofa2.position.y = -4.2;
          sofa2.position.z = 4;
          sofa2.scale.set(0.1,0.1,0.1);
          scene.add( sofa2 );
        } );

        var sofa5 = new THREE.ObjectLoader();
        sofa5.load("assets/three.js/sofa2.json", function ( sofa2 ) {
          sofa2.position.x = 10;
          sofa2.position.y = -4.2;
          sofa2.position.z = 0;
          sofa2.rotation.y = -1.55;
          sofa2.scale.set(0.1,0.1,0.1);
          scene.add( sofa2 );
        } );

        var sofa5 = new THREE.ObjectLoader();
        sofa5.load("assets/three.js/sofa2.json", function ( sofa2 ) {
          sofa2.position.x = 14;
          sofa2.position.y = -4.2;
          sofa2.position.z = -4;
          sofa2.scale.set(0.1,0.1,0.1);
          sofa2.rotation.y = 3.1;
          scene.add( sofa2 );
        } );

        var sofa6 = new THREE.ObjectLoader();
        sofa6.load("assets/three.js/sofa2.json", function ( sofa2 ) {
          sofa2.position.x = -10;
          sofa2.position.y = -4.2;
          sofa2.position.z = 0;
          sofa2.rotation.y = 1.55;
          sofa2.scale.set(0.1,0.1,0.1);
          scene.add( sofa2 );
        } );

        var sofa7 = new THREE.ObjectLoader();
        sofa7.load("assets/three.js/sofa2.json", function ( sofa2 ) {
          sofa2.position.x = -14;
          sofa2.position.y = -4.2;
          sofa2.position.z = 4;
          sofa2.scale.set(0.1,0.1,0.1);
          scene.add( sofa2 );
        } );

        var sofa8 = new THREE.ObjectLoader();
        sofa8.load("assets/three.js/sofa2.json", function ( sofa2 ) {
          sofa2.position.x = -18;
          sofa2.position.y = -4.2;
          sofa2.position.z = 0;
          sofa2.rotation.y = -1.55;
          sofa2.scale.set(0.1,0.1,0.1);
          scene.add( sofa2 );
        } );

        var sofa9 = new THREE.ObjectLoader();
        sofa9.load("assets/three.js/sofa2.json", function ( sofa2 ) {
          sofa2.position.x = -14;
          sofa2.position.y = -4.2;
          sofa2.position.z = -4;
          sofa2.scale.set(0.1,0.1,0.1);
          sofa2.rotation.y = 3.1;
          scene.add( sofa2 );
        } );

        var sofa10 = new THREE.ObjectLoader();
        sofa10.load("assets/three.js/sofa2.json", function ( sofa2 ) {
          sofa2.position.x = 4;
          sofa2.position.y = -4.2;
          sofa2.position.z = 14;
          sofa2.rotation.y = 1.55;
          sofa2.scale.set(0.1,0.1,0.1);
          scene.add( sofa2 );
        } );

        var sofa11 = new THREE.ObjectLoader();
        sofa11.load("assets/three.js/sofa2.json", function ( sofa2 ) {
          sofa2.position.y = -4.2;
          sofa2.position.z = 18;
          sofa2.scale.set(0.1,0.1,0.1);
          scene.add( sofa2 );
        } );

        var sofa12 = new THREE.ObjectLoader();
        sofa12.load("assets/three.js/sofa2.json", function ( sofa2 ) {
          sofa2.position.x = -4;
          sofa2.position.y = -4.2;
          sofa2.position.z = 14;
          sofa2.rotation.y = -1.55;
          sofa2.scale.set(0.1,0.1,0.1);
          scene.add( sofa2 );
        } );

        var sofa13 = new THREE.ObjectLoader();
        sofa13.load("assets/three.js/sofa2.json", function ( sofa2 ) {
          sofa2.position.y = -4.2;
          sofa2.position.z = 10;
          sofa2.scale.set(0.1,0.1,0.1);
          sofa2.rotation.y = 3.1;
          scene.add( sofa2 );
        } );

        var poubelle1 = new THREE.ObjectLoader();
        poubelle1.load("assets/three.js/poubelle.json", function ( poubelle ) {
          poubelle.position.x = -9;
          poubelle.position.y = -4.4;
          poubelle.position.z = -17.9;
          scene.add( poubelle );
        } );

        var poubelle2 = new THREE.ObjectLoader();
        poubelle2.load("assets/three.js/poubelle.json", function ( poubelle ) {
          poubelle.position.x = 9;
          poubelle.position.y = -4.4;
          poubelle.position.z = -17.9;
          scene.add( poubelle );
        } );

        var poubelle3 = new THREE.ObjectLoader();
        poubelle3.load("assets/three.js/poubelle.json", function ( poubelle ) {
          poubelle.position.x = -18;
          poubelle.position.y = -4.4;
          poubelle.position.z = 15;
          scene.add( poubelle );
        } );

        var poubelle4 = new THREE.ObjectLoader();
        poubelle4.load("assets/three.js/poubelle.json", function ( poubelle ) {
          poubelle.position.x = 18;
          poubelle.position.y = -4.4;
          poubelle.position.z = 15;
          scene.add( poubelle );
        } );

        var arcadeGame1 = new THREE.ObjectLoader();
        arcadeGame1.load("assets/three.js/arcadeGame.json", function ( arcadeGame ) {
          arcadeGame.position.x = -5;
          arcadeGame.position.y = -4;
          arcadeGame.position.z = -19;
          arcadeGame.rotation.y = 3.15;
          arcadeGame.scale.set(2,2,2);
          scene.add( arcadeGame );
        } );

        var arcadeGame2 = new THREE.ObjectLoader();
        arcadeGame2.load("assets/three.js/arcadeGame.json", function ( arcadeGame ) {
          arcadeGame.position.x = 0;
          arcadeGame.position.y = -4;
          arcadeGame.position.z = -19;
          arcadeGame.rotation.y = 3.15;
          arcadeGame.scale.set(2,2,2);
          scene.add( arcadeGame );
        } );

        var arcadeGame3 = new THREE.ObjectLoader();
        arcadeGame3.load("assets/three.js/arcadeGame.json", function ( arcadeGame ) {
          arcadeGame.position.x = 5;
          arcadeGame.position.y = -4;
          arcadeGame.position.z = -19;
          arcadeGame.rotation.y = 3.15;
          arcadeGame.scale.set(2,2,2);
          scene.add( arcadeGame );
        } );

        var arcadeGame4 = new THREE.ObjectLoader();
        arcadeGame4.load("assets/three.js/arcadeGame.json", function ( arcadeGame ) {
          arcadeGame.position.x = 13;
          arcadeGame.position.y = -4;
          arcadeGame.position.z = 19;
          arcadeGame.scale.set(2,2,2);
          scene.add( arcadeGame );
        } );

        var arcadeGame5 = new THREE.ObjectLoader();
        arcadeGame5.load("assets/three.js/arcadeGame.json", function ( arcadeGame ) {
          arcadeGame.position.x = -13;
          arcadeGame.position.y = -4;
          arcadeGame.position.z = 19;
          arcadeGame.scale.set(2,2,2);
          scene.add( arcadeGame );
        } );

        var fleur1 = new THREE.ObjectLoader();
        fleur1.load("assets/three.js/fleur.json", function ( fleur ) {
          fleur.position.x = 1;
          fleur.position.y = -5;
          fleur.position.z = 1;
          fleur.rotation.y = -18;
          scene.add( fleur );
        } );

        var fleur2 = new THREE.ObjectLoader();
        fleur2.load("assets/three.js/fleur.json", function ( fleur ) {
          fleur.position.x = 1;
          fleur.position.y = -5;
          fleur.position.z = -1;
          fleur.rotation.y = -35.5;
          scene.add( fleur );
        } );

        var fleur3 = new THREE.ObjectLoader();
        fleur3.load("assets/three.js/fleur.json", function ( fleur ) {
          fleur.position.x = -1;
          fleur.position.y = -5;
          fleur.position.z = 1;
          fleur.rotation.y = 18;
          scene.add( fleur );
        } );

        var fleur4 = new THREE.ObjectLoader();
        fleur4.load("assets/three.js/fleur.json", function ( fleur ) {
          fleur.position.x = -1;
          fleur.position.y = -5;
          fleur.position.z = -1;
          fleur.rotation.y = 35.5;
          scene.add( fleur );
        } );

        var lampe1 = new THREE.ObjectLoader();
        lampe1.load("assets/three.js/lampe.json", function ( lampe ) {
          lampe.position.x = -19;
          lampe.position.y = -5;
          lampe.position.z = 7;
          scene.add( lampe );
        } );

        var lampe2 = new THREE.ObjectLoader();
        lampe2.load("assets/three.js/lampe.json", function ( lampe ) {
          lampe.position.x = -19;
          lampe.position.y = -5;
          lampe.position.z = -7;
          scene.add( lampe );
        } );

        var lampe3 = new THREE.ObjectLoader();
        lampe3.load("assets/three.js/lampe.json", function ( lampe ) {
          lampe.position.x = 19;
          lampe.position.y = -5;
          lampe.position.z = 7;
          scene.add( lampe );
        } );

        var lampe4 = new THREE.ObjectLoader();
        lampe4.load("assets/three.js/lampe.json", function ( lampe ) {
          lampe.position.x = 19;
          lampe.position.y = -5;
          lampe.position.z = -7;
          scene.add( lampe );
        } );

        var lampe5 = new THREE.ObjectLoader();
        lampe5.load("assets/three.js/lampe.json", function ( lampe ) {
          lampe.position.x = 7;
          lampe.position.y = -5;
          lampe.position.z = 19;
          scene.add( lampe );
        } );

        var lampe6 = new THREE.ObjectLoader();
        lampe6.load("assets/three.js/lampe.json", function ( lampe ) {
          lampe.position.x = -7;
          lampe.position.y = -5;
          lampe.position.z = 19;
          scene.add( lampe );
        } );

        var buffet = new THREE.ObjectLoader();
        buffet.load("assets/three.js/buffet.json", function ( buffet ) {
          buffet.position.y = -4.5;
          buffet.position.z = -8.5;
          scene.add( buffet );
        } );

        var petiteTable1 = new THREE.ObjectLoader();
        petiteTable1.load("assets/three.js/petitetable.json", function ( petitetable ) {
          petitetable.position.x = -14;
          petitetable.position.y = -3;
          petitetable.position.z = -0;
          petitetable.scale.set(2,2,2);
          scene.add( petitetable );
        } );

        var petiteTable2 = new THREE.ObjectLoader();
        petiteTable2.load("assets/three.js/petitetable.json", function ( petitetable ) {
          petitetable.position.x = 14;
          petitetable.position.y = -3;
          petitetable.position.z = -0;
          petitetable.scale.set(2,2,2);
          scene.add( petitetable );
        } );

        var petiteTable3 = new THREE.ObjectLoader();
        petiteTable3.load("assets/three.js/petitetable.json", function ( petitetable ) {
          petitetable.position.x = 0;
          petitetable.position.y = -3;
          petitetable.position.z = 14;
          petitetable.scale.set(2,2,2);
          scene.add( petitetable );
        } );

        var petiteTable4 = new THREE.ObjectLoader();
        petiteTable4.load("assets/three.js/petitetable.json", function ( petitetable ) {
          petitetable.position.x = 13;
          petitetable.position.y = -3;
          petitetable.position.z = -13;
          petitetable.scale.set(2,2,2);
          scene.add( petitetable );
        } );

        var petiteTable5 = new THREE.ObjectLoader();
        petiteTable5.load("assets/three.js/petitetable.json", function ( petitetable ) {
          petitetable.position.x = -13;
          petitetable.position.y = -3;
          petitetable.position.z = -13;
          petitetable.scale.set(2,2,2);
          scene.add( petitetable );
        } );
		}

		function onWindowResize() {
			camera.aspect = window.innerWidth / window.innerHeight;
			camera.updateProjectionMatrix();
			renderer.setSize( window.innerWidth, window.innerHeight );
		}

		function animate() {
		    requestAnimationFrame( animate );
		    renderer.render( scene, camera );
		}
		</script>
	</body>
</html>

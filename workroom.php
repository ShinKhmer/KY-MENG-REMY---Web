<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Salle de travail de Work'n Share</title>
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

				var bureau1 = new THREE.ObjectLoader();
				bureau1.load("assets/three.js/bureau.json", function ( bureau ) {
					bureau.position.x = -12;
					bureau.position.y = -3.5;
					bureau.position.z = -19.5;
					bureau.scale.set(3,3,3);
				 	scene.add( bureau );
				} );

				var chaise1 = new THREE.ObjectLoader();
				chaise1.load("assets/three.js/chaise.json", function ( chaise ) {
					chaise.position.x = -13;
					chaise.position.y = -5;
					chaise.position.z = -16;
				 	scene.add( chaise );
				} );

				var ordinateur1 = new THREE.ObjectLoader();
				ordinateur1.load("assets/three.js/ordinateur.json", function ( ordinateur ) {
					ordinateur.position.x = -13;
					ordinateur.position.y = -0.5;
					ordinateur.position.z = -19;
					ordinateur.rotation.y = 4.7;
				 	scene.add( ordinateur );
				} );

				var bureau2 = new THREE.ObjectLoader();
				bureau2.load("assets/three.js/bureau.json", function ( bureau ) {
					bureau.position.x = -5;
					bureau.position.y = -3.5;
					bureau.position.z = -19.5;
					bureau.scale.set(3,3,3);
				 	scene.add( bureau );
				} );

				var chaise2 = new THREE.ObjectLoader();
				chaise2.load("assets/three.js/chaise.json", function ( chaise ) {
					chaise.position.x = -6;
					chaise.position.y = -5;
					chaise.position.z = -16;
				 	scene.add( chaise );
				} );

				var ordinateur2 = new THREE.ObjectLoader();
				ordinateur2.load("assets/three.js/ordinateur.json", function ( ordinateur ) {
					ordinateur.position.x = -6;
					ordinateur.position.y = -0.5;
					ordinateur.position.z = -19;
					ordinateur.rotation.y = 4.7;
				 	scene.add( ordinateur );
				} );

				var bureau3 = new THREE.ObjectLoader();
				bureau3.load("assets/three.js/bureau.json", function ( bureau ) {
					bureau.position.x = 2;
					bureau.position.y = -3.5;
					bureau.position.z = -19.5;
					bureau.scale.set(3,3,3);
				 	scene.add( bureau );
				} );

				var chaise3 = new THREE.ObjectLoader();
				chaise3.load("assets/three.js/chaise.json", function ( chaise ) {
					chaise.position.x = 1;
					chaise.position.y = -5;
					chaise.position.z = -16;
				 	scene.add( chaise );
				} );

				var ordinateur3 = new THREE.ObjectLoader();
				ordinateur3.load("assets/three.js/ordinateur.json", function ( ordinateur ) {
					ordinateur.position.x = 1;
					ordinateur.position.y = -0.5;
					ordinateur.position.z = -19;
					ordinateur.rotation.y = 4.7;
				 	scene.add( ordinateur );
				} );

				var bureau4 = new THREE.ObjectLoader();
				bureau4.load("assets/three.js/bureau.json", function ( bureau ) {
					bureau.position.x = 9;
					bureau.position.y = -3.5;
					bureau.position.z = -19.5;
					bureau.scale.set(3,3,3);
				 	scene.add( bureau );
				} );

				var chaise4 = new THREE.ObjectLoader();
				chaise4.load("assets/three.js/chaise.json", function ( chaise ) {
					chaise.position.x = 8;
					chaise.position.y = -5;
					chaise.position.z = -16;
				 	scene.add( chaise );
				} );

				var ordinateur4 = new THREE.ObjectLoader();
				ordinateur4.load("assets/three.js/ordinateur.json", function ( ordinateur ) {
					ordinateur.position.x = 8;
					ordinateur.position.y = -0.5;
					ordinateur.position.z = -19;
					ordinateur.rotation.y = 4.7;
				 	scene.add( ordinateur );
				} );

				var bureau5 = new THREE.ObjectLoader();
				bureau5.load("assets/three.js/bureau.json", function ( bureau ) {
					bureau.position.x = 16;
					bureau.position.y = -3.5;
					bureau.position.z = -19.5;
					bureau.scale.set(3,3,3);
				 	scene.add( bureau );
				} );

				var chaise5 = new THREE.ObjectLoader();
				chaise5.load("assets/three.js/chaise.json", function ( chaise ) {
					chaise.position.x = 15;
					chaise.position.y = -5;
					chaise.position.z = -16;
				 	scene.add( chaise );
				} );

				var ordinateur5 = new THREE.ObjectLoader();
				ordinateur5.load("assets/three.js/ordinateur.json", function ( ordinateur ) {
					ordinateur.position.x = 15;
					ordinateur.position.y = -0.5;
					ordinateur.position.z = -19;
					ordinateur.rotation.y = 4.7;
				 	scene.add( ordinateur );
				} );

				var bureau6 = new THREE.ObjectLoader();
				bureau6.load("assets/three.js/bureau.json", function ( bureau ) {
					bureau.position.x = -10;
					bureau.position.y = -3.5;
					bureau.position.z = -8;
					bureau.rotation.y = 1.6;
					bureau.scale.set(3,3,3);
				 	scene.add( bureau );
				} );

				var chaise6 = new THREE.ObjectLoader();
				chaise6.load("assets/three.js/chaise.json", function ( chaise ) {
					chaise.position.x = -12;
					chaise.position.y = -5;
					chaise.position.z = -7;
					chaise.rotation.y = -1.6;
				 	scene.add( chaise );
				} );

				var ordinateur6 = new THREE.ObjectLoader();
				ordinateur6.load("assets/three.js/ordinateur.json", function ( ordinateur ) {
					ordinateur.position.x = -9;
					ordinateur.position.y = -0.5;
					ordinateur.position.z = -7;
					ordinateur.rotation.y = -3.1;
				 	scene.add( ordinateur );
				} );

				var bureau7 = new THREE.ObjectLoader();
				bureau7.load("assets/three.js/bureau.json", function ( bureau ) {
					bureau.position.x = -10;
					bureau.position.y = -3.5;
					bureau.position.z = -2;
					bureau.rotation.y = 1.6;
					bureau.scale.set(3,3,3);
				 	scene.add( bureau );
				} );

				var chaise7 = new THREE.ObjectLoader();
				chaise7.load("assets/three.js/chaise.json", function ( chaise ) {
					chaise.position.x = -12;
					chaise.position.y = -5;
					chaise.position.z = -1;
					chaise.rotation.y = -1.6;
				 	scene.add( chaise );
				} );

				var ordinateur7 = new THREE.ObjectLoader();
				ordinateur7.load("assets/three.js/ordinateur.json", function ( ordinateur ) {
					ordinateur.position.x = -9;
					ordinateur.position.y = -0.5;
					ordinateur.position.z = -1;
					ordinateur.rotation.y = -3.1;
				 	scene.add( ordinateur );
				} );

				var bureau8 = new THREE.ObjectLoader();
				bureau8.load("assets/three.js/bureau.json", function ( bureau ) {
					bureau.position.x = -10;
					bureau.position.y = -3.5;
					bureau.position.z = 4;
					bureau.rotation.y = 1.6;
					bureau.scale.set(3,3,3);
				 	scene.add( bureau );
				} );

				var chaise8 = new THREE.ObjectLoader();
				chaise8.load("assets/three.js/chaise.json", function ( chaise ) {
					chaise.position.x = -12;
					chaise.position.y = -5;
					chaise.position.z = 5;
					chaise.rotation.y = -1.6;
				 	scene.add( chaise );
				} );

				var ordinateur8 = new THREE.ObjectLoader();
				ordinateur8.load("assets/three.js/ordinateur.json", function ( ordinateur ) {
					ordinateur.position.x = -9;
					ordinateur.position.y = -0.5;
					ordinateur.position.z = 5;
					ordinateur.rotation.y = -3.1;
				 	scene.add( ordinateur );
				} );

				var bureau9 = new THREE.ObjectLoader();
				bureau9.load("assets/three.js/bureau.json", function ( bureau ) {
					bureau.position.x = -10;
					bureau.position.y = -3.5;
					bureau.position.z = 10;
					bureau.rotation.y = 1.6;
					bureau.scale.set(3,3,3);
				 	scene.add( bureau );
				} );

				var chaise9 = new THREE.ObjectLoader();
				chaise9.load("assets/three.js/chaise.json", function ( chaise ) {
					chaise.position.x = -12;
					chaise.position.y = -5;
					chaise.position.z = 11;
					chaise.rotation.y = -1.6;
				 	scene.add( chaise );
				} );

				var ordinateur9 = new THREE.ObjectLoader();
				ordinateur9.load("assets/three.js/ordinateur.json", function ( ordinateur ) {
					ordinateur.position.x = -9;
					ordinateur.position.y = -0.5;
					ordinateur.position.z = 11;
					ordinateur.rotation.y = -3.1;
				 	scene.add( ordinateur );
				} );

				var bureau10 = new THREE.ObjectLoader();
				bureau10.load("assets/three.js/bureau.json", function ( bureau ) {
					bureau.position.x = -6;
					bureau.position.y = -3.5;
					bureau.position.z = -5.7;
					bureau.rotation.y = -1.55;
					bureau.scale.set(3,3,3);
				 	scene.add( bureau );
				} );

				var chaise10 = new THREE.ObjectLoader();
				chaise10.load("assets/three.js/chaise.json", function ( chaise ) {
					chaise.position.x = -4;
					chaise.position.y = -5;
					chaise.position.z = -7;
					chaise.rotation.y = 1.6;
				 	scene.add( chaise );
				} );

				var ordinateur10 = new THREE.ObjectLoader();
				ordinateur10.load("assets/three.js/ordinateur.json", function ( ordinateur ) {
					ordinateur.position.x = -7;
					ordinateur.position.y = -0.5;
					ordinateur.position.z = -7;
				 	scene.add( ordinateur );
				} );

				var bureau11 = new THREE.ObjectLoader();
				bureau11.load("assets/three.js/bureau.json", function ( bureau ) {
					bureau.position.x = -6;
					bureau.position.y = -3.5;
					bureau.position.z = 0.3;
					bureau.rotation.y = -1.55;
					bureau.scale.set(3,3,3);
				 	scene.add( bureau );
				} );

				var chaise11 = new THREE.ObjectLoader();
				chaise11.load("assets/three.js/chaise.json", function ( chaise ) {
					chaise.position.x = -4;
					chaise.position.y = -5;
					chaise.position.z = -1;
					chaise.rotation.y = 1.6;
				 	scene.add( chaise );
				} );

				var ordinateur11 = new THREE.ObjectLoader();
				ordinateur11.load("assets/three.js/ordinateur.json", function ( ordinateur ) {
					ordinateur.position.x = -7;
					ordinateur.position.y = -0.5;
					ordinateur.position.z = -1;
				 	scene.add( ordinateur );
				} );

				var bureau12 = new THREE.ObjectLoader();
				bureau12.load("assets/three.js/bureau.json", function ( bureau ) {
					bureau.position.x = -6;
					bureau.position.y = -3.5;
					bureau.position.z = 6.3;
					bureau.rotation.y = -1.55;
					bureau.scale.set(3,3,3);
				 	scene.add( bureau );
				} );

				var chaise12 = new THREE.ObjectLoader();
				chaise12.load("assets/three.js/chaise.json", function ( chaise ) {
					chaise.position.x = -4;
					chaise.position.y = -5;
					chaise.position.z = 5;
					chaise.rotation.y = 1.6;
				 	scene.add( chaise );
				} );

				var ordinateur12 = new THREE.ObjectLoader();
				ordinateur12.load("assets/three.js/ordinateur.json", function ( ordinateur ) {
					ordinateur.position.x = -7;
					ordinateur.position.y = -0.5;
					ordinateur.position.z = 5;
				 	scene.add( ordinateur );
				} );

				var bureau13 = new THREE.ObjectLoader();
				bureau13.load("assets/three.js/bureau.json", function ( bureau ) {
					bureau.position.x = -6;
					bureau.position.y = -3.5;
					bureau.position.z = 12.3;
					bureau.rotation.y = -1.55;
					bureau.scale.set(3,3,3);
				 	scene.add( bureau );
				} );

				var chaise13 = new THREE.ObjectLoader();
				chaise13.load("assets/three.js/chaise.json", function ( chaise ) {
					chaise.position.x = -4;
					chaise.position.y = -5;
					chaise.position.z = 11;
					chaise.rotation.y = 1.6;
				 	scene.add( chaise );
				} );

				var ordinateur13 = new THREE.ObjectLoader();
				ordinateur13.load("assets/three.js/ordinateur.json", function ( ordinateur ) {
					ordinateur.position.x = -7;
					ordinateur.position.y = -0.5;
					ordinateur.position.z = 11;
				 	scene.add( ordinateur );
				} );

				var bureau14 = new THREE.ObjectLoader();
				bureau14.load("assets/three.js/bureau.json", function ( bureau ) {
					bureau.position.x = 4;
					bureau.position.y = -3.5;
					bureau.position.z = -8;
					bureau.rotation.y = 1.6;
					bureau.scale.set(3,3,3);
				 	scene.add( bureau );
				} );

				var chaise14 = new THREE.ObjectLoader();
				chaise14.load("assets/three.js/chaise.json", function ( chaise ) {
					chaise.position.x = 2;
					chaise.position.y = -5;
					chaise.position.z = -7;
					chaise.rotation.y = -1.6;
				 	scene.add( chaise );
				} );

				var ordinateur14 = new THREE.ObjectLoader();
				ordinateur14.load("assets/three.js/ordinateur.json", function ( ordinateur ) {
					ordinateur.position.x = 5;
					ordinateur.position.y = -0.5;
					ordinateur.position.z = -7;
					ordinateur.rotation.y = -3.1;
				 	scene.add( ordinateur );
				} );

				var bureau15 = new THREE.ObjectLoader();
				bureau15.load("assets/three.js/bureau.json", function ( bureau ) {
					bureau.position.x = 4;
					bureau.position.y = -3.5;
					bureau.position.z = -2;
					bureau.rotation.y = 1.6;
					bureau.scale.set(3,3,3);
				 	scene.add( bureau );
				} );

				var chaise15 = new THREE.ObjectLoader();
				chaise15.load("assets/three.js/chaise.json", function ( chaise ) {
					chaise.position.x = 2;
					chaise.position.y = -5;
					chaise.position.z = -1;
					chaise.rotation.y = -1.6;
				 	scene.add( chaise );
				} );

				var ordinateur15 = new THREE.ObjectLoader();
				ordinateur15.load("assets/three.js/ordinateur.json", function ( ordinateur ) {
					ordinateur.position.x = 5;
					ordinateur.position.y = -0.5;
					ordinateur.position.z = -1;
					ordinateur.rotation.y = -3.1;
				 	scene.add( ordinateur );
				} );

				var bureau16 = new THREE.ObjectLoader();
				bureau16.load("assets/three.js/bureau.json", function ( bureau ) {
					bureau.position.x = 4;
					bureau.position.y = -3.5;
					bureau.position.z = 4;
					bureau.rotation.y = 1.6;
					bureau.scale.set(3,3,3);
				 	scene.add( bureau );
				} );

				var chaise16 = new THREE.ObjectLoader();
				chaise16.load("assets/three.js/chaise.json", function ( chaise ) {
					chaise.position.x = 2;
					chaise.position.y = -5;
					chaise.position.z = 5;
					chaise.rotation.y = -1.6;
				 	scene.add( chaise );
				} );

				var ordinateur16 = new THREE.ObjectLoader();
				ordinateur16.load("assets/three.js/ordinateur.json", function ( ordinateur ) {
					ordinateur.position.x = 5;
					ordinateur.position.y = -0.5;
					ordinateur.position.z = 5;
					ordinateur.rotation.y = -3.1;
				 	scene.add( ordinateur );
				} );

				var bureau17 = new THREE.ObjectLoader();
				bureau17.load("assets/three.js/bureau.json", function ( bureau ) {
					bureau.position.x = 4;
					bureau.position.y = -3.5;
					bureau.position.z = 10;
					bureau.rotation.y = 1.6;
					bureau.scale.set(3,3,3);
				 	scene.add( bureau );
				} );

				var chaise17 = new THREE.ObjectLoader();
				chaise17.load("assets/three.js/chaise.json", function ( chaise ) {
					chaise.position.x = 2;
					chaise.position.y = -5;
					chaise.position.z = 11;
					chaise.rotation.y = -1.6;
				 	scene.add( chaise );
				} );

				var ordinateur17 = new THREE.ObjectLoader();
				ordinateur17.load("assets/three.js/ordinateur.json", function ( ordinateur ) {
					ordinateur.position.x = 5;
					ordinateur.position.y = -0.5;
					ordinateur.position.z = 11;
					ordinateur.rotation.y = -3.1;
				 	scene.add( ordinateur );
				} );

				var bureau18 = new THREE.ObjectLoader();
				bureau18.load("assets/three.js/bureau.json", function ( bureau ) {
					bureau.position.x = 8;
					bureau.position.y = -3.5;
					bureau.position.z = -5.7;
					bureau.rotation.y = -1.55;
					bureau.scale.set(3,3,3);
				 	scene.add( bureau );
				} );

				var chaise18 = new THREE.ObjectLoader();
				chaise18.load("assets/three.js/chaise.json", function ( chaise ) {
					chaise.position.x = 10;
					chaise.position.y = -5;
					chaise.position.z = -7;
					chaise.rotation.y = 1.6;
				 	scene.add( chaise );
				} );

				var ordinateur18 = new THREE.ObjectLoader();
				ordinateur18.load("assets/three.js/ordinateur.json", function ( ordinateur ) {
					ordinateur.position.x = 7;
					ordinateur.position.y = -0.5;
					ordinateur.position.z = -7;
				 	scene.add( ordinateur );
				} );

				var bureau19 = new THREE.ObjectLoader();
				bureau19.load("assets/three.js/bureau.json", function ( bureau ) {
					bureau.position.x = 8;
					bureau.position.y = -3.5;
					bureau.position.z = 0.3;
					bureau.rotation.y = -1.55;
					bureau.scale.set(3,3,3);
				 	scene.add( bureau );
				} );

				var chaise19 = new THREE.ObjectLoader();
				chaise19.load("assets/three.js/chaise.json", function ( chaise ) {
					chaise.position.x = 10;
					chaise.position.y = -5;
					chaise.position.z = -1;
					chaise.rotation.y = 1.6;
				 	scene.add( chaise );
				} );

				var ordinateur19 = new THREE.ObjectLoader();
				ordinateur19.load("assets/three.js/ordinateur.json", function ( ordinateur ) {
					ordinateur.position.x = 7;
					ordinateur.position.y = -0.5;
					ordinateur.position.z = -1;
				 	scene.add( ordinateur );
				} );

				var bureau20 = new THREE.ObjectLoader();
				bureau20.load("assets/three.js/bureau.json", function ( bureau ) {
					bureau.position.x = 8;
					bureau.position.y = -3.5;
					bureau.position.z = 6.3;
					bureau.rotation.y = -1.55;
					bureau.scale.set(3,3,3);
				 	scene.add( bureau );
				} );

				var chaise20 = new THREE.ObjectLoader();
				chaise20.load("assets/three.js/chaise.json", function ( chaise ) {
					chaise.position.x = 10;
					chaise.position.y = -5;
					chaise.position.z = 5;
					chaise.rotation.y = 1.6;
				 	scene.add( chaise );
				} );

				var ordinateur20 = new THREE.ObjectLoader();
				ordinateur20.load("assets/three.js/ordinateur.json", function ( ordinateur ) {
					ordinateur.position.x = 7;
					ordinateur.position.y = -0.5;
					ordinateur.position.z = 5;
				 	scene.add( ordinateur );
				} );

				var bureau21 = new THREE.ObjectLoader();
				bureau21.load("assets/three.js/bureau.json", function ( bureau ) {
					bureau.position.x = 8;
					bureau.position.y = -3.5;
					bureau.position.z = 12.3;
					bureau.rotation.y = -1.55;
					bureau.scale.set(3,3,3);
				 	scene.add( bureau );
				} );

				var chaise21 = new THREE.ObjectLoader();
				chaise21.load("assets/three.js/chaise.json", function ( chaise ) {
					chaise.position.x = 10;
					chaise.position.y = -5;
					chaise.position.z = 11;
					chaise.rotation.y = 1.6;
				 	scene.add( chaise );
				} );

				var ordinateur21 = new THREE.ObjectLoader();
				ordinateur21.load("assets/three.js/ordinateur.json", function ( ordinateur ) {
					ordinateur.position.x = 7;
					ordinateur.position.y = -0.5;
					ordinateur.position.z = 11;
				 	scene.add( ordinateur );
				} );

				var poubelle1 = new THREE.ObjectLoader();
				poubelle1.load("assets/three.js/poubelle.json", function ( poubelle ) {
					poubelle.position.x = -18;
					poubelle.position.y = -4.4;
					poubelle.position.z = -18;
				 	scene.add( poubelle );
				} );

				var poubelle2 = new THREE.ObjectLoader();
				poubelle2.load("assets/three.js/poubelle.json", function ( poubelle ) {
					poubelle.position.x = 5;
					poubelle.position.y = -4.4;
					poubelle.position.z = 20;
				 	scene.add( poubelle );
				} );

				var fleur1 = new THREE.ObjectLoader();
				fleur1.load("assets/three.js/fleur.json", function ( fleur ) {
					fleur.position.x = 18;
					fleur.position.y = -5;
					fleur.position.z = 18;
					fleur.rotation.y = 35.5;
					scene.add( fleur );
				} );

				var fleur2 = new THREE.ObjectLoader();
				fleur2.load("assets/three.js/fleur.json", function ( fleur ) {
					fleur.position.x = -18;
					fleur.position.y = -5;
					fleur.position.z = 18;
					fleur.rotation.y = -35.5;
					scene.add( fleur );
				} );

				var fleur3 = new THREE.ObjectLoader();
				fleur3.load("assets/three.js/fleur.json", function ( fleur ) {
					fleur.position.x = -19;
					fleur.position.y = -5;
					fleur.position.z = -13;
					fleur.rotation.y = -18;
				 	scene.add( fleur );
				} );

				var buffet = new THREE.ObjectLoader();
				buffet.load("assets/three.js/buffet.json", function ( buffet ) {
					buffet.position.x = -1;
					buffet.position.y = -4.5;
					buffet.position.z = 17;
				 	scene.add( buffet );
				} );

				var lampe1 = new THREE.ObjectLoader();
				lampe1.load("assets/three.js/lampe.json", function ( lampe ) {
					lampe.position.x = -7;
					lampe.position.y = -5;
					lampe.position.z = 19;
				 	scene.add( lampe );
				} );

				var lampe2 = new THREE.ObjectLoader();
				lampe2.load("assets/three.js/lampe.json", function ( lampe ) {
					lampe.position.x = 18;
					lampe.position.y = -5;
					lampe.position.z = 7;
				 	scene.add( lampe );
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

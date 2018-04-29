<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Salle de réunion de Work'n Share</title>
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

        var table = new THREE.ObjectLoader();
        table.load("assets/three.js/table.json", function ( table ) {
          table.position.y = -5;
          scene.add( table );
        } );

        var chaise1 = new THREE.ObjectLoader();
        chaise1.load("assets/three.js/chaise.json", function ( chaise ) {
          chaise.position.x = -5;
          chaise.position.y = -5;
          chaise.rotation.y = 4.7;
          scene.add( chaise );
        } );

        var chaise2 = new THREE.ObjectLoader();
        chaise2.load("assets/three.js/chaise.json", function ( chaise ) {
          chaise.position.x = -5;
          chaise.position.y = -5;
          chaise.position.z = -3;
          chaise.rotation.y = 4.7;
          scene.add( chaise );
        } );

        var chaise3 = new THREE.ObjectLoader();
        chaise3.load("assets/three.js/chaise.json", function ( chaise ) {
          chaise.position.x = -5;
          chaise.position.y = -5;
          chaise.position.z = 3;
          chaise.rotation.y = 4.7;
          scene.add( chaise );
        } );

        var chaise4 = new THREE.ObjectLoader();
        chaise4.load("assets/three.js/chaise.json", function ( chaise ) {
          chaise.position.x = 5;
          chaise.position.y = -5;
          chaise.rotation.y = -4.7;
          scene.add( chaise );
        } );

        var chaise5 = new THREE.ObjectLoader();
        chaise5.load("assets/three.js/chaise.json", function ( chaise ) {
          chaise.position.x = 5;
          chaise.position.y = -5;
          chaise.position.z = -3;
          chaise.rotation.y = -4.7;
          scene.add( chaise );
        } );

        var chaise5 = new THREE.ObjectLoader();
        chaise5.load("assets/three.js/chaise.json", function ( chaise ) {
          chaise.position.x = 5;
          chaise.position.y = -5;
          chaise.position.z = 3;
          chaise.rotation.y = -4.7;
          scene.add( chaise );
        } );

        var chaise6 = new THREE.ObjectLoader();
        chaise6.load("assets/three.js/chaise.json", function ( chaise ) {
          chaise.position.y = -5;
          chaise.position.z = -8;
          chaise.rotation.y = 3.15;
          scene.add( chaise );
        } );

        var chaise7 = new THREE.ObjectLoader();
        chaise7.load("assets/three.js/chaise.json", function ( chaise ) {
          chaise.position.y = -5;
          chaise.position.z = 8;
          scene.add( chaise );
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
          fleur.position.x = 18;
          fleur.position.y = -5;
          fleur.position.z = -18;
          fleur.rotation.y = 18;
          scene.add( fleur );
        } );

        var fleur3 = new THREE.ObjectLoader();
        fleur3.load("assets/three.js/fleur.json", function ( fleur ) {
          fleur.position.x = -18;
          fleur.position.y = -5;
          fleur.position.z = 18;
          fleur.rotation.y = -35.5;
          scene.add( fleur );
        } );

        var fleur4 = new THREE.ObjectLoader();
        fleur4.load("assets/three.js/fleur.json", function ( fleur ) {
          fleur.position.x = -18;
          fleur.position.y = -5;
          fleur.position.z = -18;
          fleur.rotation.y = -18;
          scene.add( fleur );
        } );

        var buffet = new THREE.ObjectLoader();
        buffet.load("assets/three.js/buffet.json", function ( buffet ) {
          buffet.position.x = -15;
          buffet.position.y = -4.5;
          scene.add( buffet );
        } );

        var poubelle1 = new THREE.ObjectLoader();
        poubelle1.load("assets/three.js/poubelle.json", function ( poubelle ) {
          poubelle.position.x = -18;
          poubelle.position.y = -4.4;
          poubelle.position.z = -4;
          scene.add( poubelle );
        } );

        var lampe1 = new THREE.ObjectLoader();
        lampe1.load("assets/three.js/lampe.json", function ( lampe ) {
          lampe.position.x = -17;
          lampe.position.y = -5;
          lampe.position.z = 7;
          scene.add( lampe );
        } );

        var lampe2 = new THREE.ObjectLoader();
        lampe2.load("assets/three.js/lampe.json", function ( lampe ) {
          lampe.position.x = 17;
          lampe.position.y = -5;
          lampe.position.z = -7;
          scene.add( lampe );
        } );

        var grandeTable = new THREE.ObjectLoader();
        grandeTable.load("assets/three.js/grandetable.json", function ( grandetable ) {
          grandetable.position.x = 0;
          grandetable.position.y = -5;
          grandetable.position.z = -18;
          grandetable.scale.set(6,2,5);
          scene.add( grandetable );
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

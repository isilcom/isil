<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Panorama Viewer</title>
  <style>
    body {
      margin: 0;
      overflow: hidden;
    }

    #pano {
      width: 100%;
      height: 100%;
    }
  </style>
</head>
<body>
  <div id="pano"></div>

  <script src="https://unpkg.com/three@0.126.1/build/three.min.js"></script>
  <script src="https://unpkg.com/three@0.126.1/examples/js/loaders/PanoramaLoader.js"></script>

  <script>
    // Create a new Three.js scene
    var scene = new THREE.Scene();

    // Create a new perspective camera
    var camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);

    // Create a new WebGL renderer
    var renderer = new THREE.WebGLRenderer();
    renderer.setSize(window.innerWidth, window.innerHeight);

    // Add the renderer to the DOM
    document.body.appendChild(renderer.domElement);

    // Create a new panorama loader
    var loader = new THREE.PanoramaLoader();

    // Load the panorama image
    loader.load('path/to/po.jpg', function (texture) {

      // Create a new panorama geometry
      var geometry = new THREE.SphereGeometry(500, 60, 40);

      // Create a new panorama material
      var material = new THREE.MeshBasicMaterial({
        map: texture
      });

      // Create a new panorama mesh
      var mesh = new THREE.Mesh(geometry, material);

      // Add the panorama mesh to the scene
      scene.add(mesh);

    });

    // Create a new event listener for the window resize event
    window.addEventListener('resize', function() {

      // Update the camera aspect ratio
      camera.aspect = window.innerWidth / window.innerHeight;

      // Update the camera projection matrix
      camera.updateProjectionMatrix();

      // Update the renderer size
      renderer.setSize(window.innerWidth, window.innerHeight);

    });

    // Create a new animation loop
    function animate() {

      // Request the next animation frame
      requestAnimationFrame(animate);

      // Render the scene
      renderer.render(scene, camera);

    }

    // Start the animation loop
    animate();
  </script>
</body>
</html>
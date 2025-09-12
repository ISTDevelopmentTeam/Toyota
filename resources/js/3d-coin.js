// 3D Coin rendering with Three.js

class CoinRenderer {
    constructor() {
        this.scene = null;
        this.camera = null;
        this.renderer = null;
        this.coin = null;
        
        this.navScene = null;
        this.navCamera = null;
        this.navRenderer = null;
        this.navCoin = null;
    }

    // Initialize main 3D coin
    init3DCoin() {
        try {
            this.createMainCoin();
            this.createNavCoin();
            this.animate();
        } catch (error) {
            console.error('Failed to initialize 3D coin:', error);
        }
    }

    createMainCoin() {
        // Create scene
        this.scene = new THREE.Scene();
        
        // Create camera
        this.camera = new THREE.PerspectiveCamera(
            APP_CONFIG.coin.camera.fov, 
            1, 
            0.1, 
            1000
        );
        this.camera.position.z = APP_CONFIG.coin.camera.position.main.z;
        
        // Create renderer
        this.renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
        this.renderer.setSize(320, 320);
        this.renderer.setClearColor(0x000000, 0);
        
        const container = document.getElementById('coin-container');
        if (container) {
            container.appendChild(this.renderer.domElement);
        }
        
        // Create lighting
        this.addLighting(this.scene);
        
        // Create the coin
        this.coin = this.createCoinMesh(
            APP_CONFIG.coin.geometry.main.radius, 
            APP_CONFIG.coin.geometry.main.height
        );
        this.coin.rotation.z = Math.PI / 2;
        this.scene.add(this.coin);
    }

    createNavCoin() {
        // Create nav scene
        this.navScene = new THREE.Scene();
        
        // Create nav camera
        this.navCamera = new THREE.PerspectiveCamera(
            APP_CONFIG.coin.camera.fov, 
            1, 
            0.1, 
            1000
        );
        this.navCamera.position.z = APP_CONFIG.coin.camera.position.nav.z;
        
        // Create nav renderer
        this.navRenderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
        this.navRenderer.setSize(50, 50);
        this.navRenderer.setClearColor(0x000000, 0);
        
        const navContainer = document.getElementById('nav-coin-container');
        if (navContainer) {
            navContainer.appendChild(this.navRenderer.domElement);
        }
        
        // Create lighting for nav coin
        this.addLighting(this.navScene);
        
        // Create the nav coin
        this.navCoin = this.createCoinMesh(
            APP_CONFIG.coin.geometry.nav.radius, 
            APP_CONFIG.coin.geometry.nav.height
        );
        this.navCoin.rotation.z = Math.PI / 2;
        this.navScene.add(this.navCoin);
    }

    addLighting(scene) {
        const ambientLight = new THREE.AmbientLight(0x404040, 0.4);
        scene.add(ambientLight);
        
        const directionalLight = new THREE.DirectionalLight(0xffffff, 1.2);
        directionalLight.position.set(2, 2, 5);
        scene.add(directionalLight);
    }

    createCoinMesh(radius, height) {
        // Create coin geometry
        const coinGeometry = new THREE.CylinderGeometry(radius, radius, height, 32);
        
        // Create materials
        const toyotaMaterial = this.createToyotaMaterial();
        const aapMaterial = this.createAAPMaterial();
        const edgeMaterial = new THREE.MeshPhongMaterial({
            color: 0xc0c0c0,
            shininess: 100
        });
        
        // Apply materials to coin faces
        const materials = [
            edgeMaterial,   // side
            toyotaMaterial, // top (Toyota)
            aapMaterial     // bottom (AAP)
        ];
        
        return new THREE.Mesh(coinGeometry, materials);
    }

    createToyotaMaterial() {
        const loader = new THREE.TextureLoader();
        const texture = loader.load(APP_CONFIG.assets.images.toyota);
        
        return new THREE.MeshPhongMaterial({ 
            map: texture, 
            shininess: 50 
        });
    }

    createAAPMaterial() {
        const loader = new THREE.TextureLoader();
        const texture = loader.load(APP_CONFIG.assets.images.aap);
        
        return new THREE.MeshPhongMaterial({ 
            map: texture, 
            shininess: 50 
        });
    }

    animate() {
        requestAnimationFrame(() => this.animate());
        
        // Rotate main coin
        if (this.coin) {
            this.coin.rotation.y += APP_CONFIG.coin.rotation.main;
            this.renderer.render(this.scene, this.camera);
        }
        
        // Rotate nav coin
        if (this.navCoin) {
            this.navCoin.rotation.y += APP_CONFIG.coin.rotation.nav;
            this.navRenderer.render(this.navScene, this.navCamera);
        }
    }

    // Handle window resize
    onWindowResize() {
        if (this.camera && this.renderer) {
            this.renderer.setSize(320, 320);
        }
        
        if (this.navCamera && this.navRenderer) {
            this.navRenderer.setSize(50, 50);
        }
    }

    // Cleanup resources
    dispose() {
        if (this.renderer) {
            this.renderer.dispose();
        }
        if (this.navRenderer) {
            this.navRenderer.dispose();
        }
    }
}

// Create global instance
const coinRenderer = new CoinRenderer();
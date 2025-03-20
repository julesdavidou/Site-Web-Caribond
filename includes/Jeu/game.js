// Canvas Asteroids
//
// Copyright (c) 2010 Doug McInnes
//

KEY_CODES = {
    32: 'space',
    37: 'left',
    38: 'up',
    39: 'right',
    40: 'down',
    70: 'f',
    71: 'g',
    72: 'h',
    77: 'm',
    80: 'p'
  }
  
  KEY_STATUS = { keyDown:false };
  for (code in KEY_CODES) {
    KEY_STATUS[KEY_CODES[code]] = false;
  }
  
  $(window).keydown(function (e) {
    KEY_STATUS.keyDown = true;
    if (KEY_CODES[e.keyCode]) {
      e.preventDefault();
      KEY_STATUS[KEY_CODES[e.keyCode]] = true;
    }
  }).keyup(function (e) {
    KEY_STATUS.keyDown = false;
    if (KEY_CODES[e.keyCode]) {
      e.preventDefault();
      KEY_STATUS[KEY_CODES[e.keyCode]] = false;
    }
  });
  
  GRID_SIZE = 60;
  
  Matrix = function (rows, columns) {
    var i, j;
    this.data = new Array(rows);
    for (i = 0; i < rows; i++) {
      this.data[i] = new Array(columns);
    }
  
    this.configure = function (rot, scale, transx, transy) {
      var rad = (rot * Math.PI)/180;
      var sin = Math.sin(rad) * scale;
      var cos = Math.cos(rad) * scale;
      this.set(cos, -sin, transx,
               sin,  cos, transy);
    };
  
    this.set = function () {
      var k = 0;
      for (i = 0; i < rows; i++) {
        for (j = 0; j < columns; j++) {
          this.data[i][j] = arguments[k];
          k++;
        }
      }
    }
  
    this.multiply = function () {
      var vector = new Array(rows);
      for (i = 0; i < rows; i++) {
        vector[i] = 0;
        for (j = 0; j < columns; j++) {
          vector[i] += this.data[i][j] * arguments[j];
        }
      }
      return vector;
    };
  };
  
  Sprite = function () {
    this.init = function (name, points) {
      this.name     = name;
      this.points   = points;
  
      this.vel = {
        x:   0,
        y:   0,
        rot: 0
      };
  
      this.acc = {
        x:   0,
        y:   0,
        rot: 0
      };
    };
  
    this.children = {};
  
    this.visible  = false;
    this.reap     = false;
    this.bridgesH = true;
    this.bridgesV = true;
  
    this.collidesWith = [];
  
    this.x     = 0;
    this.y     = 0;
    this.rot   = 0;
    this.scale = 1;
  
    this.currentNode = null;
    this.nextSprite  = null;
  
    this.preMove  = null;
    this.postMove = null;
  
    this.run = function(delta) {
  
      this.move(delta);
      this.updateGrid();
  
      this.context.save();
      this.configureTransform();
      this.draw();
  
      var canidates = this.findCollisionCanidates();
  
      this.matrix.configure(this.rot, this.scale, this.x, this.y);
      this.checkCollisionsAgainst(canidates);
  
      this.context.restore();
  
      if (this.bridgesH && this.currentNode && this.currentNode.dupe.horizontal) {
        this.x += this.currentNode.dupe.horizontal;
        this.context.save();
        this.configureTransform();
        this.draw();
        this.checkCollisionsAgainst(canidates);
        this.context.restore();
        if (this.currentNode) {
          this.x -= this.currentNode.dupe.horizontal;
        }
      }
      if (this.bridgesV && this.currentNode && this.currentNode.dupe.vertical) {
        this.y += this.currentNode.dupe.vertical;
        this.context.save();
        this.configureTransform();
        this.draw();
        this.checkCollisionsAgainst(canidates);
        this.context.restore();
        if (this.currentNode) {
          this.y -= this.currentNode.dupe.vertical;
        }
      }
      if (this.bridgesH && this.bridgesV &&
          this.currentNode &&
          this.currentNode.dupe.vertical &&
          this.currentNode.dupe.horizontal) {
        this.x += this.currentNode.dupe.horizontal;
        this.y += this.currentNode.dupe.vertical;
        this.context.save();
        this.configureTransform();
        this.draw();
        this.checkCollisionsAgainst(canidates);
        this.context.restore();
        if (this.currentNode) {
          this.x -= this.currentNode.dupe.horizontal;
          this.y -= this.currentNode.dupe.vertical;
        }
      }
    };
    this.move = function (delta) {
      if (!this.visible) return;
      this.transPoints = null; // clear cached points
  
      if ($.isFunction(this.preMove)) {
        this.preMove(delta);
      }
  
      this.vel.x += this.acc.x * delta;
      this.vel.y += this.acc.y * delta;
      this.x += this.vel.x * delta;
      this.y += this.vel.y * delta;
      this.rot += this.vel.rot * delta;
      if (this.rot > 360) {
        this.rot -= 360;
      } else if (this.rot < 0) {
        this.rot += 360;
      }
  
      if ($.isFunction(this.postMove)) {
        this.postMove(delta);
      }
    };
    this.updateGrid = function () {
      if (!this.visible) return;
      var gridx = Math.floor(this.x / GRID_SIZE);
      var gridy = Math.floor(this.y / GRID_SIZE);
      gridx = (gridx >= this.grid.length) ? 0 : gridx;
      gridy = (gridy >= this.grid[0].length) ? 0 : gridy;
      gridx = (gridx < 0) ? this.grid.length-1 : gridx;
      gridy = (gridy < 0) ? this.grid[0].length-1 : gridy;
      var newNode = this.grid[gridx][gridy];
      if (newNode != this.currentNode) {
        if (this.currentNode) {
          this.currentNode.leave(this);
        }
        newNode.enter(this);
        this.currentNode = newNode;
      }
  
      if (KEY_STATUS.g && this.currentNode) {
        this.context.lineWidth = 3.0;
        this.context.strokeStyle = 'green';
        this.context.strokeRect(gridx*GRID_SIZE+2, gridy*GRID_SIZE+2, GRID_SIZE-4, GRID_SIZE-4);
        this.context.strokeStyle = 'black';
        this.context.lineWidth = 1.0;
      }
    };
    this.configureTransform = function () {
      if (!this.visible) return;
  
      var rad = (this.rot * Math.PI)/180;
  
      this.context.translate(this.x, this.y);
      this.context.rotate(rad);
      this.context.scale(this.scale, this.scale);
    };
    this.draw = function () {
      if (!this.visible) return;
  
      this.context.lineWidth = 1.0 / this.scale;
  
      for (child in this.children) {
        this.context.save(); // Sauvegarde le contexte avant de dessiner l'enfant
        this.children[child].configureTransform(); // Applique son x/y/rot/scale
        this.children[child].draw(); // Dessine l'enfant
        this.context.restore(); // Restaure l'état pour les suivants
      }
      
  
      this.context.beginPath();
  
      this.context.moveTo(this.points[0], this.points[1]);
      for (var i = 1; i < this.points.length/2; i++) {
        var xi = i*2;
        var yi = xi + 1;
        this.context.lineTo(this.points[xi], this.points[yi]);
      }
  
      this.context.closePath();
      this.context.stroke();
    };
    this.findCollisionCanidates = function () {
      if (!this.visible || !this.currentNode) return [];
      var cn = this.currentNode;
      var canidates = [];
      if (cn.nextSprite) canidates.push(cn.nextSprite);
      if (cn.north.nextSprite) canidates.push(cn.north.nextSprite);
      if (cn.south.nextSprite) canidates.push(cn.south.nextSprite);
      if (cn.east.nextSprite) canidates.push(cn.east.nextSprite);
      if (cn.west.nextSprite) canidates.push(cn.west.nextSprite);
      if (cn.north.east.nextSprite) canidates.push(cn.north.east.nextSprite);
      if (cn.north.west.nextSprite) canidates.push(cn.north.west.nextSprite);
      if (cn.south.east.nextSprite) canidates.push(cn.south.east.nextSprite);
      if (cn.south.west.nextSprite) canidates.push(cn.south.west.nextSprite);
      return canidates
    };
    this.checkCollisionsAgainst = function (canidates) {
      for (var i = 0; i < canidates.length; i++) {
        var ref = canidates[i];
        do {
          this.checkCollision(ref);
          ref = ref.nextSprite;
        } while (ref)
      }
    };
    this.checkCollision = function (other) {
      if (!other.visible ||
           this == other ||
           this.collidesWith.indexOf(other.name) == -1) return;
      var trans = other.transformedPoints();
      var px, py;
      var count = trans.length/2;
      for (var i = 0; i < count; i++) {
        px = trans[i*2];
        py = trans[i*2 + 1];
        // mozilla doesn't take into account transforms with isPointInPath >:-P
        if (($.browser.mozilla) ? this.pointInPolygon(px, py) : this.context.isPointInPath(px, py)) {
          other.collision(this);
          this.collision(other);
          return;
        }
      }
    };
    this.pointInPolygon = function (x, y) {
      var points = this.transformedPoints();
      var j = 2;
      var y0, y1;
      var oddNodes = false;
      for (var i = 0; i < points.length; i += 2) {
        y0 = points[i + 1];
        y1 = points[j + 1];
        if ((y0 < y && y1 >= y) ||
            (y1 < y && y0 >= y)) {
          if (points[i]+(y-y0)/(y1-y0)*(points[j]-points[i]) < x) {
            oddNodes = !oddNodes;
          }
        }
        j += 2
        if (j == points.length) j = 0;
      }
      return oddNodes;
    };
    this.collision = function () {
    };
    this.die = function () {
      this.visible = false;
      this.reap = true;
      if (this.currentNode) {
        this.currentNode.leave(this);
        this.currentNode = null;
      }
    };
    this.transformedPoints = function () {
      if (this.transPoints) return this.transPoints;
      var trans = new Array(this.points.length);
      this.matrix.configure(this.rot, this.scale, this.x, this.y);
      for (var i = 0; i < this.points.length/2; i++) {
        var xi = i*2;
        var yi = xi + 1;
        var pts = this.matrix.multiply(this.points[xi], this.points[yi], 1);
        trans[xi] = pts[0];
        trans[yi] = pts[1];
      }
      this.transPoints = trans; // cache translated points
      return trans;
    };
    this.isClear = function () {
      if (this.collidesWith.length == 0) return true;
      var cn = this.currentNode;
      if (cn == null) {
        var gridx = Math.floor(this.x / GRID_SIZE);
        var gridy = Math.floor(this.y / GRID_SIZE);
        gridx = (gridx >= this.grid.length) ? 0 : gridx;
        gridy = (gridy >= this.grid[0].length) ? 0 : gridy;
        cn = this.grid[gridx][gridy];
      }
      return (cn.isEmpty(this.collidesWith) &&
              cn.north.isEmpty(this.collidesWith) &&
              cn.south.isEmpty(this.collidesWith) &&
              cn.east.isEmpty(this.collidesWith) &&
              cn.west.isEmpty(this.collidesWith) &&
              cn.north.east.isEmpty(this.collidesWith) &&
              cn.north.west.isEmpty(this.collidesWith) &&
              cn.south.east.isEmpty(this.collidesWith) &&
              cn.south.west.isEmpty(this.collidesWith));
    };
    this.wrapPostMove = function () {
      if (this.x > Game.canvasWidth) {
        this.x = 0;
      } else if (this.x < 0) {
        this.x = Game.canvasWidth;
      }
      if (this.y > Game.canvasHeight) {
        this.y = 0;
      } else if (this.y < 0) {
        this.y = Game.canvasHeight;
      }
    };
  
  };
  
  Ship = function () {
    var offsetX = 21.225;  // inverse de la moyenne X pour le centrage
    var offsetY = -25.123; // inverse de la moyenne Y pour le centrage
    this.init("ship", [
      -13.702 + offsetX, 6.33 + offsetY,
      -22.149 + offsetX, 6.33 + offsetY,
      -22.149 + offsetX, 31.598 + offsetY,
      -22.221 + offsetX, 22.509 + offsetY,
      -28.221 + offsetX, 22.518 + offsetY,
      -28.221 + offsetX, 31.761 + offsetY,
      -22.008 + offsetX, 31.761 + offsetY,
      -36.51 + offsetX, 31.761 + offsetY,
      -36.51 + offsetX, 39.957 + offsetY,
      -23.616 + offsetX, 37.174 + offsetY,
      -21.063 + offsetX, 39.421 + offsetY,
      -20.144 + offsetX, 39.727 + offsetY,
      -19.659 + offsetX, 37.812 + offsetY,
      -19.033 + offsetX, 37.424 + offsetY,
      -13.315 + offsetX, 35.691 + offsetY,
      -12.485 + offsetX, 35.412 + offsetY,
      -12.485 + offsetX, 33.395 + offsetY,
      -13.659 + offsetX, 33.395 + offsetY,
      -13.685 + offsetX, 8.578 + offsetY,
      -12.485 + offsetX, 7.991 + offsetY,
      -13.711 + offsetX, 7.276 + offsetY,
      -13.702 + offsetX, 6.331 + offsetY
    ]);
    
  
    this.children.exhaust = new Sprite();
    this.children.exhaust.init("exhaust",
                               [-3,  6,
                                 0, 11,
                                 3,  6]);

    this.children.exhaust.x = 0;     // Centré sur l'axe X
    this.children.exhaust.y = 15;    // À 20 unités derrière le centre du vaisseau

    this.bulletCounter = 0;
  
    this.postMove = this.wrapPostMove;
  
    this.collidesWith = ["asteroid", "bigalien", "alienbullet"];
  
    this.preMove = function (delta) {
      if (KEY_STATUS.left) {
        this.vel.rot = -10;
      } else if (KEY_STATUS.right) {
        this.vel.rot = 10;
      } else {
        this.vel.rot = 0;
      }
  
      if (KEY_STATUS.up) {
        var rad = ((this.rot-90) * Math.PI)/180;
        this.acc.x = 0.5 * Math.cos(rad);
        this.acc.y = 0.5 * Math.sin(rad);
        this.children.exhaust.visible = Math.random() > 0.1;
      } else {
        this.acc.x = 0;
        this.acc.y = 0;

        // Applique la friction sur la vitesse directement
        this.vel.x *= 0.994;  // Ajuste le facteur ici
        this.vel.y *= 0.994;

        this.children.exhaust.visible = false;
      }
  
      if (this.bulletCounter > 0) {
        this.bulletCounter -= delta;
      }
      if (KEY_STATUS.space) {
        if (this.bulletCounter <= 0) {
          this.bulletCounter = 5;
          for (var i = 0; i < this.bullets.length; i++) {
            if (!this.bullets[i].visible) {
              SFX.laser();
              var bullet = this.bullets[i];
              var bulletLocalX = 20;    // Ajuste ça selon où est le canon du gun en X
              var bulletLocalY = 0; // Ajuste ça selon où est le canon du gun en Y

              var rad = ((this.rot - 90) * Math.PI) / 180;
              var cos = Math.cos(rad);
              var sin = Math.sin(rad);

              // Transformation locale -> globale
              var rotatedX = bulletLocalX * cos - bulletLocalY * sin;
              var rotatedY = bulletLocalX * sin + bulletLocalY * cos;

              bullet.x = this.x + rotatedX;
              bullet.y = this.y + rotatedY;

              // Direction du tir (si tu veux qu'il parte en ligne droite depuis le nez)
              bullet.vel.x = 6 * cos + this.vel.x;
              bullet.vel.y = 6 * sin + this.vel.y;

              bullet.visible = true;
              break;
            }
          }
        }
      }
  
      // limit the ship's speed
      if (Math.sqrt(this.vel.x * this.vel.x + this.vel.y * this.vel.y) > 8) {
        this.vel.x *= 0.95;
        this.vel.y *= 0.95;
      }
    };
  
    this.collision = function (other) {
      SFX.explosion();
      Game.explosionAt(other.x, other.y);
      Game.FSM.state = 'player_died';
      this.visible = false;
      this.currentNode.leave(this);
      this.currentNode = null;
      Game.lives--;
    };
  
  };
  Ship.prototype = new Sprite();
  
  BigAlien = function () {
    const offsetX = 23.883; // Centre X calculé
    const offsetY = 23.949; // Centre Y calculé
    
    this.init("bigalien", 
      [6.717 - offsetX, 30.545 - offsetY,
      9.279 - offsetX, 27.089 - offsetY,
      12.64 - offsetX, 32.519 - offsetY,
      16.606 - offsetX, 27.055 - offsetY,
      19.943 - offsetX, 32.434 - offsetY,
      23.649 - offsetX, 27.052 - offsetY,
      27.304 - offsetX, 32.387 - offsetY,
      31.091 - offsetX, 26.97 - offsetY,
      34.76 - offsetX, 32.345 - offsetY,
      38.623 - offsetX, 26.94 - offsetY,
      40.714 - offsetX, 30.43 - offsetY,
      37.832 - offsetX, 32.383 - offsetY,
      9.73 - offsetX, 32.519 - offsetY,
      6.615 - offsetX, 30.391 - offsetY,
      5.415 - offsetX, 27.055 - offsetY,
      16.93 - offsetX, 27.055 - offsetY,
      19.245 - offsetX, 17.83 - offsetY,
      22.615 - offsetX, 15.379 - offsetY,
      24.964 - offsetX, 15.379 - offsetY,
      27.96 - offsetX, 17.711 - offsetY,
      30.138 - offsetX, 25.047 - offsetY,
      28.526 - offsetX, 19.619 - offsetY,
      18.79 - offsetX, 19.641 - offsetY,
      17.832 - offsetX, 23.462 - offsetY,
      29.638 - offsetX, 23.44 - offsetY,
      30.708 - offsetX, 26.94 - offsetY,
      42.351 - offsetX, 26.847 - offsetY,
      40.714 - offsetX, 30.43 - offsetY,
      38.623 - offsetX, 26.94 - offsetY,
      9.343 - offsetX, 27.055 - offsetY,
      6.717 - offsetX, 30.545 - offsetY
    ]);
    
  
    this.children.top = new Sprite();
    this.children.top.init("bigalien_top",
                           [-8, -4,
                            -6, -6,
                             6, -6,
                             8, -4]);
    this.children.top.visible = false; // rend invisible
  
    this.children.bottom = new Sprite();
    this.children.bottom.init("bigalien_top",
                              [ 8, 4,
                                6, 6,
                               -6, 6,
                               -8, 4]);
    this.children.bottom.visible = false; //rend invisible
  
    this.collidesWith = ["asteroid", "ship", "bullet"];
  
    this.bridgesH = false;
  
    this.bullets = [];
    this.bulletCounter = 0;
  
    this.newPosition = function () {
      if (Math.random() < 0.5) {
        this.x = -20;
        this.vel.x = 1.5;
      } else {
        this.x = Game.canvasWidth + 20;
        this.vel.x = -1.5;
      }
      this.y = Math.random() * Game.canvasHeight;
    };
  
    this.setup = function () {
      this.newPosition();
  
      for (var i = 0; i < 3; i++) {
        var bull = new AlienBullet();
        this.bullets.push(bull);
        Game.sprites.push(bull);
      }
    };
  
    this.preMove = function (delta) {
      var cn = this.currentNode;
      if (cn == null) return;
  
      var topCount = 0;
      if (cn.north.nextSprite) topCount++;
      if (cn.north.east.nextSprite) topCount++;
      if (cn.north.west.nextSprite) topCount++;
  
      var bottomCount = 0;
      if (cn.south.nextSprite) bottomCount++;
      if (cn.south.east.nextSprite) bottomCount++;
      if (cn.south.west.nextSprite) bottomCount++;
  
      if (topCount > bottomCount) {
        this.vel.y = 1;
      } else if (topCount < bottomCount) {
        this.vel.y = -1;
      } else if (Math.random() < 0.01) {
        this.vel.y = -this.vel.y;
      }
  
      this.bulletCounter -= delta;
      if (this.bulletCounter <= 0) {
        this.bulletCounter = 22;
        for (var i = 0; i < this.bullets.length; i++) {
          if (!this.bullets[i].visible) {
            bullet = this.bullets[i];
            var rad = 2 * Math.PI * Math.random();
            var vectorx = Math.cos(rad);
            var vectory = Math.sin(rad);
            bullet.x = this.x;
            bullet.y = this.y;
            bullet.vel.x = 6 * vectorx;
            bullet.vel.y = 6 * vectory;
            bullet.visible = true;
            SFX.laser();
            break;
          }
        }
      }
  
    };
  
    BigAlien.prototype.collision = function (other) {
      if (other.name == "bullet") Game.score += 200;
      SFX.explosion();
      Game.explosionAt(other.x, other.y);
      this.visible = false;
      this.newPosition();
    };
  
    this.postMove = function () {
      if (this.y > Game.canvasHeight) {
        this.y = 0;
      } else if (this.y < 0) {
        this.y = Game.canvasHeight;
      }
  
      if ((this.vel.x > 0 && this.x > Game.canvasWidth + 20) ||
          (this.vel.x < 0 && this.x < -20)) {
        // why did the alien cross the road?
        this.visible = false;
        this.newPosition();
      }
    }
  };
  BigAlien.prototype = new Sprite();
  
  Bullet = function () {
    this.init("bullet", [0, 0]);
    this.time = 0;
    this.bridgesH = false;
    this.bridgesV = false;
    this.postMove = this.wrapPostMove;
    // asteroid can look for bullets so doesn't have
    // to be other way around
    //this.collidesWith = ["asteroid"];
  
    this.configureTransform = function () {};
    this.draw = function () {
      if (this.visible) {
        this.context.save();
        this.context.lineWidth = 2;
        this.context.beginPath();
        this.context.moveTo(this.x-1, this.y-1);
        this.context.lineTo(this.x+1, this.y+1);
        this.context.moveTo(this.x+1, this.y-1);
        this.context.lineTo(this.x-1, this.y+1);
        this.context.stroke();
        this.context.restore();
      }
    };
    this.preMove = function (delta) {
      if (this.visible) {
        this.time += delta;
      }
      if (this.time > 50) {
        this.visible = false;
        this.time = 0;
      }
    };
    this.collision = function (other) {
      this.time = 0;
      this.visible = false;
      this.currentNode.leave(this);
      this.currentNode = null;
    };
    this.transformedPoints = function (other) {
      return [this.x, this.y];
    };
  
  };
  Bullet.prototype = new Sprite();
  
  AlienBullet = function () {
    this.init("alienbullet");
  
    this.draw = function () {
      if (this.visible) {
        this.context.save();
        this.context.lineWidth = 2;
        this.context.beginPath();
        this.context.moveTo(this.x, this.y);
        this.context.lineTo(this.x-this.vel.x, this.y-this.vel.y);
        this.context.stroke();
        this.context.restore();
      }
    };
  };
  AlienBullet.prototype = new Bullet();
  
  Asteroid = function () {
    var offsetX = -24.085; // Centre en X
    var offsetY = -24.1885; // Centre en Y
    this.init("asteroid", [
      22.131 + offsetX, 20.932 + offsetY,
      21.546 + offsetX, 21.848 + offsetY,
      25.563 + offsetX, 26.835 + offsetY,
      23.05  + offsetX, 26.807 + offsetY,
      25.307 + offsetX, 23.89  + offsetY,
      23.698 + offsetX, 19.294 + offsetY,
      24.552 + offsetX, 17.868 + offsetY,
      23.622 + offsetX, 17.881 + offsetY,
      23.554 + offsetX, 19.345 + offsetY,
      22.89  + offsetX, 21.064 + offsetY,
      22.881 + offsetX, 21.775 + offsetY,
      23.877 + offsetX, 22.817 + offsetY,
      22.294 + offsetX, 24.4   + offsetY,
      23.026 + offsetX, 25.03  + offsetY,
      25.46  + offsetX, 25.166 + offsetY,
      26.975 + offsetX, 23.566 + offsetY,
      27.06  + offsetX, 19.515 + offsetY,
      26.294 + offsetX, 18.953 + offsetY,
      25.953 + offsetX, 19.548 + offsetY,
      26.958 + offsetX, 19.566 + offsetY,
      25.954 + offsetX, 22.068 + offsetY,
      26.924 + offsetX, 21.2   + offsetY,
      25.914 + offsetX, 19.75  + offsetY,
      25.852 + offsetX, 22.136 + offsetY,
      26.806 + offsetX, 23.423 + offsetY,
      25.828 + offsetX, 22.937 + offsetY,
      25.853 + offsetX, 22.136 + offsetY,
      25.85  + offsetX, 22.493 + offsetY,
      25.807 + offsetX, 23.329 + offsetY,
      25.808 + offsetX, 23.683 + offsetY,
      26.863 + offsetX, 23.578 + offsetY,
      25.61  + offsetX, 25.008 + offsetY,
      25.799 + offsetX, 23.119 + offsetY,
      25.225 + offsetX, 23.653 + offsetY,
      23.893 + offsetX, 22.74  + offsetY,
      25.208 + offsetX, 20.831 + offsetY,
      22.799 + offsetX, 18.623 + offsetY,
      22.85  + offsetX, 23.4   + offsetY,
      21.919 + offsetX, 22.476 + offsetY,
      21.11  + offsetX, 23.378 + offsetY,
      23.008 + offsetX, 25.114 + offsetY,
      22.965 + offsetX, 26.833 + offsetY,
      21.944 + offsetX, 26.867 + offsetY,
      23.374 + offsetX, 28.195 + offsetY,
      26.463 + offsetX, 26.978 + offsetY,
      26.148 + offsetX, 28.618 + offsetY,
      23.274 + offsetX, 28.174 + offsetY,
      22.831 + offsetX, 30.508 + offsetY,
      26.133 + offsetX, 28.691 + offsetY,
      25.792 + offsetX, 30.442 + offsetY,
      24.986 + offsetX, 29.359 + offsetY,
      25.732 + offsetX, 30.51  + offsetY,
      22.799 + offsetX, 30.554 + offsetY,
      21.853 + offsetX, 26.887 + offsetY,
      26.525 + offsetX, 26.878 + offsetY,
      25.623 + offsetX, 26.818 + offsetY,
      25.576 + offsetX, 26.043 + offsetY,
      25.598 + offsetX, 24.49  + offsetY,
      25.686 + offsetX, 23.72  + offsetY,
      25.256 + offsetX, 23.631 + offsetY,
      25.219 + offsetX, 18.695 + offsetY,
      24.593 + offsetX, 17.823 + offsetY,
      23.516 + offsetX, 17.823 + offsetY,
      22.742 + offsetX, 18.636 + offsetY,
      22.791 + offsetX, 23.253 + offsetY,
      22.465 + offsetX, 22.857 + offsetY,
      22.493 + offsetX, 21.827 + offsetY,
      21.11  + offsetX, 21.818 + offsetY,
      21.089 + offsetX, 23.331 + offsetY,
      21.115 + offsetX, 21.616 + offsetY,
      21.681 + offsetX, 20.782 + offsetY,
      22.17  + offsetX, 20.7   + offsetY,
      22.496 + offsetX, 21.794 + offsetY,
      22.131 + offsetX, 20.929 + offsetY
    ]);    
  
    this.visible = true;
    this.scale = 6;
    this.postMove = this.wrapPostMove;
  
    this.collidesWith = ["ship", "bullet", "bigalien", "alienbullet"];
  
    this.collision = function (other) {
      SFX.explosion();
      if (other.name == "bullet") Game.score += 120 / this.scale;
      this.scale /= 2;
      if (this.scale > 1) {
        // break into fragments
        for (var i = 0; i < 3; i++) {
          var roid = $.extend(true, {}, this);
          roid.vel.x = Math.random() * 6 - 3;
          roid.vel.y = Math.random() * 6 - 3;
          if (Math.random() > 0.5) {
            roid.points.reverse();
          }
          roid.vel.rot = Math.random() * 2 - 1;
          roid.move(roid.scale * 3); // give them a little push
          Game.sprites.push(roid);
        }
      }
      Game.explosionAt(other.x, other.y);
      this.die();
    };
  };
  Asteroid.prototype = new Sprite();
  
  Explosion = function () {
    this.init("explosion");
  
    this.bridgesH = false;
    this.bridgesV = false;
  
    this.lines = [];
    for (var i = 0; i < 5; i++) {
      var rad = 2 * Math.PI * Math.random();
      var x = Math.cos(rad);
      var y = Math.sin(rad);
      this.lines.push([x, y, x*2, y*2]);
    }
  
    this.draw = function () {
      if (this.visible) {
        this.context.save();
        this.context.lineWidth = 1.0 / this.scale;
        this.context.beginPath();
        for (var i = 0; i < 5; i++) {
          var line = this.lines[i];
          this.context.moveTo(line[0], line[1]);
          this.context.lineTo(line[2], line[3]);
        }
        this.context.stroke();
        this.context.restore();
      }
    };
  
    this.preMove = function (delta) {
      if (this.visible) {
        this.scale += delta;
      }
      if (this.scale > 8) {
        this.die();
      }
    };
  };
  Explosion.prototype = new Sprite();
  
  GridNode = function () {
    this.north = null;
    this.south = null;
    this.east  = null;
    this.west  = null;
  
    this.nextSprite = null;
  
    this.dupe = {
      horizontal: null,
      vertical:   null
    };
  
    this.enter = function (sprite) {
      sprite.nextSprite = this.nextSprite;
      this.nextSprite = sprite;
    };
  
    this.leave = function (sprite) {
      var ref = this;
      while (ref && (ref.nextSprite != sprite)) {
        ref = ref.nextSprite;
      }
      if (ref) {
        ref.nextSprite = sprite.nextSprite;
        sprite.nextSprite = null;
      }
    };
  
    this.eachSprite = function(sprite, callback) {
      var ref = this;
      while (ref.nextSprite) {
        ref = ref.nextSprite;
        callback.call(sprite, ref);
      }
    };
  
    this.isEmpty = function (collidables) {
      var empty = true;
      var ref = this;
      while (ref.nextSprite) {
        ref = ref.nextSprite;
        empty = !ref.visible || collidables.indexOf(ref.name) == -1
        if (!empty) break;
      }
      return empty;
    };
  };
  
  // borrowed from typeface-0.14.js
  // http://typeface.neocracy.org
  Text = {
    renderGlyph: function (ctx, face, char) {
  
      var glyph = face.glyphs[char];
  
      if (glyph.o) {
  
        var outline;
        if (glyph.cached_outline) {
          outline = glyph.cached_outline;
        } else {
          outline = glyph.o.split(' ');
          glyph.cached_outline = outline;
        }
  
        var outlineLength = outline.length;
        for (var i = 0; i < outlineLength; ) {
  
          var action = outline[i++];
  
          switch(action) {
            case 'm':
              ctx.moveTo(outline[i++], outline[i++]);
              break;
            case 'l':
              ctx.lineTo(outline[i++], outline[i++]);
              break;
  
            case 'q':
              var cpx = outline[i++];
              var cpy = outline[i++];
              ctx.quadraticCurveTo(outline[i++], outline[i++], cpx, cpy);
              break;
  
            case 'b':
              var x = outline[i++];
              var y = outline[i++];
              ctx.bezierCurveTo(outline[i++], outline[i++], outline[i++], outline[i++], x, y);
              break;
          }
        }
      }
      if (glyph.ha) {
        ctx.translate(glyph.ha, 0);
      }
    },
  
    renderText: function(text, size, x, y) {
      this.context.save();
  
      this.context.translate(x, y);
  
      var pixels = size * 72 / (this.face.resolution * 100);
      this.context.scale(pixels, -1 * pixels);
      this.context.beginPath();
      var chars = text.split('');
      var charsLength = chars.length;
      for (var i = 0; i < charsLength; i++) {
        this.renderGlyph(this.context, this.face, chars[i]);
      }
      this.context.fill();
  
      this.context.restore();
    },
  
    context: null,
    face: null
  };
  
  SFX = {
    laser:     new Audio('includes/Jeu/39459__THE_bizniss__laser.wav'),
    explosion: new Audio('includes/Jeu/51467__smcameron__missile_explosion.wav')
  };
  
  // preload audio
  for (var sfx in SFX) {
    (function () {
      var audio = SFX[sfx];
      audio.muted = true;
      audio.play();
  
      SFX[sfx] = function () {
        if (!this.muted) {
          if (audio.duration == 0) {
            // somehow dropped out
            audio.load();
            audio.play();
          } else {
            audio.muted = false;
            audio.currentTime = 0;
          }
        }
        return audio;
      }
    })();
  }
  // pre-mute audio
  SFX.muted = true;
  
  Game = {
    score: 0,
    totalAsteroids: 5,
    lives: 0,
  
    canvasWidth: 800,
    canvasHeight: 600,
  
    sprites: [],
    ship: null,
    bigAlien: null,
  
    nextBigAlienTime: null,
  
  
    spawnAsteroids: function (count) {
      if (!count) count = this.totalAsteroids;
      for (var i = 0; i < count; i++) {
        var roid = new Asteroid();
        roid.x = Math.random() * this.canvasWidth;
        roid.y = Math.random() * this.canvasHeight;
        while (!roid.isClear()) {
          roid.x = Math.random() * this.canvasWidth;
          roid.y = Math.random() * this.canvasHeight;
        }
        roid.vel.x = Math.random() * 4 - 2;
        roid.vel.y = Math.random() * 4 - 2;
        if (Math.random() > 0.5) {
          roid.points.reverse();
        }
        roid.vel.rot = Math.random() * 2 - 1;
        Game.sprites.push(roid);
      }
    },
  
    explosionAt: function (x, y) {
      var splosion = new Explosion();
      splosion.x = x;
      splosion.y = y;
      splosion.visible = true;
      Game.sprites.push(splosion);
    },
  
    FSM: {
      boot: function () {
        Game.spawnAsteroids(5);
        this.state = 'waiting';
      },
      waiting: function () {
        Text.renderText(window.ipad ? 'Touch Screen to Start' : 'Press Space to Start', 36, Game.canvasWidth/2 - 270, Game.canvasHeight/2);
        if (KEY_STATUS.space || window.gameStart) {
          KEY_STATUS.space = false; // hack so we don't shoot right away
          window.gameStart = false;
          this.state = 'start';
        }
      },
      start: function () {
        for (var i = 0; i < Game.sprites.length; i++) {
          if (Game.sprites[i].name == 'asteroid') {
            Game.sprites[i].die();
          } else if (Game.sprites[i].name == 'bullet' ||
                     Game.sprites[i].name == 'bigalien') {
            Game.sprites[i].visible = false;
          }
        }
  
        Game.score = 0;
        Game.lives = 2;
        Game.totalAsteroids = 2;
        Game.spawnAsteroids();
  
        Game.nextBigAlienTime = Date.now() + 30000 + (30000 * Math.random());
  
        this.state = 'spawn_ship';
      },
      spawn_ship: function () {
        Game.ship.x = Game.canvasWidth / 2;
        Game.ship.y = Game.canvasHeight / 2;
        if (Game.ship.isClear()) {
          Game.ship.rot = 0;
          Game.ship.vel.x = 0;
          Game.ship.vel.y = 0;
          Game.ship.visible = true;
          this.state = 'run';
        }
      },
      run: function () {
        for (var i = 0; i < Game.sprites.length; i++) {
          if (Game.sprites[i].name == 'asteroid') {
            break;
          }
        }
        if (i == Game.sprites.length) {
          this.state = 'new_level';
        }
        if (!Game.bigAlien.visible &&
            Date.now() > Game.nextBigAlienTime) {
          Game.bigAlien.visible = true;
          Game.nextBigAlienTime = Date.now() + (30000 * Math.random());
        }
      },
      new_level: function () {
        if (this.timer == null) {
          this.timer = Date.now();
        }
        // wait a second before spawning more asteroids
        if (Date.now() - this.timer > 1000) {
          this.timer = null;
          Game.totalAsteroids++;
          if (Game.totalAsteroids > 12) Game.totalAsteroids = 12;
          Game.spawnAsteroids();
          this.state = 'run';
        }
      },
      player_died: function () {
        if (Game.lives < 0) {
          this.state = 'end_game';
        } else {
          if (this.timer == null) {
            this.timer = Date.now();
          }
          // wait a second before spawning
          if (Date.now() - this.timer > 1000) {
            this.timer = null;
            this.state = 'spawn_ship';
          }
        }
      },
      end_game: function () {
        Text.renderText('GAME OVER', 50, Game.canvasWidth/2 - 160, Game.canvasHeight/2 + 10);
        if (this.timer == null) {
          this.timer = Date.now();
        }
        // wait 5 seconds then go back to waiting state
        if (Date.now() - this.timer > 5000) {
          this.timer = null;
          this.state = 'waiting';
        }
  
        window.gameStart = false;
      },
  
      execute: function () {
        this[this.state]();
      },
      state: 'boot'
    }
  
  };
  
  
  $(function () {
    var canvas = $("#canvas");
    Game.canvasWidth  = canvas.width();
    Game.canvasHeight = canvas.height();
  
    var context = canvas[0].getContext("2d");
  
    Text.context = context;
    Text.face = vector_battle;
  
    var gridWidth = Math.round(Game.canvasWidth / GRID_SIZE);
    var gridHeight = Math.round(Game.canvasHeight / GRID_SIZE);
    var grid = new Array(gridWidth);
    for (var i = 0; i < gridWidth; i++) {
      grid[i] = new Array(gridHeight);
      for (var j = 0; j < gridHeight; j++) {
        grid[i][j] = new GridNode();
      }
    }
  
    // set up the positional references
    for (var i = 0; i < gridWidth; i++) {
      for (var j = 0; j < gridHeight; j++) {
        var node   = grid[i][j];
        node.north = grid[i][(j == 0) ? gridHeight-1 : j-1];
        node.south = grid[i][(j == gridHeight-1) ? 0 : j+1];
        node.west  = grid[(i == 0) ? gridWidth-1 : i-1][j];
        node.east  = grid[(i == gridWidth-1) ? 0 : i+1][j];
      }
    }
  
    // set up borders
    for (var i = 0; i < gridWidth; i++) {
      grid[i][0].dupe.vertical            =  Game.canvasHeight;
      grid[i][gridHeight-1].dupe.vertical = -Game.canvasHeight;
    }
  
    for (var j = 0; j < gridHeight; j++) {
      grid[0][j].dupe.horizontal           =  Game.canvasWidth;
      grid[gridWidth-1][j].dupe.horizontal = -Game.canvasWidth;
    }
  
    var sprites = [];
    Game.sprites = sprites;
  
    // so all the sprites can use it
    Sprite.prototype.context = context;
    Sprite.prototype.grid    = grid;
    Sprite.prototype.matrix  = new Matrix(2, 3);
  
    var ship = new Ship();
  
    ship.x = Game.canvasWidth / 2;
    ship.y = Game.canvasHeight / 2;
  
    sprites.push(ship);
  
    ship.bullets = [];
    for (var i = 0; i < 10; i++) {
      var bull = new Bullet();
      ship.bullets.push(bull);
      sprites.push(bull);
    }
    Game.ship = ship;
  
    var bigAlien = new BigAlien();
    bigAlien.setup();
    sprites.push(bigAlien);
    Game.bigAlien = bigAlien;
  
    var extraDude = new Ship();
    extraDude.scale = 0.6;
    extraDude.visible = true;
    extraDude.preMove = null;
    extraDude.children = [];
  
    var i, j = 0;
  
    var paused = false;
    var showFramerate = false;
    var avgFramerate = 0;
    var frameCount = 0;
    var elapsedCounter = 0;
  
    var lastFrame = Date.now();
    var thisFrame;
    var elapsed;
    var delta;
  
    var canvasNode = canvas[0];
  
    // shim layer with setTimeout fallback
    // from here:
    // http://paulirish.com/2011/requestanimationframe-for-smart-animating/
    window.requestAnimFrame = (function () {
      return  window.requestAnimationFrame       ||
              window.webkitRequestAnimationFrame ||
              window.mozRequestAnimationFrame    ||
              window.oRequestAnimationFrame      ||
              window.msRequestAnimationFrame     ||
              function (/* function */ callback, /* DOMElement */ element) {
                window.setTimeout(callback, 1000 / 60);
              };
    })();
  
    var mainLoop = function () {
      context.clearRect(0, 0, Game.canvasWidth, Game.canvasHeight);
  
      Game.FSM.execute();
  
      if (KEY_STATUS.g) {
        context.beginPath();
        for (var i = 0; i < gridWidth; i++) {
          context.moveTo(i * GRID_SIZE, 0);
          context.lineTo(i * GRID_SIZE, Game.canvasHeight);
        }
        for (var j = 0; j < gridHeight; j++) {
          context.moveTo(0, j * GRID_SIZE);
          context.lineTo(Game.canvasWidth, j * GRID_SIZE);
        }
        context.closePath();
        context.stroke();
      }
  
      thisFrame = Date.now();
      elapsed = thisFrame - lastFrame;
      lastFrame = thisFrame;
      delta = elapsed / 30;
  
      for (i = 0; i < sprites.length; i++) {
  
        sprites[i].run(delta);
  
        if (sprites[i].reap) {
          sprites[i].reap = false;
          sprites.splice(i, 1);
          i--;
        }
      }
  
      // score
      var score_text = ''+Game.score;
      Text.renderText(score_text, 18, Game.canvasWidth - 14 * score_text.length, 20);
  
      // extra dudes
      for (i = 0; i < Game.lives; i++) {
        context.save();
        extraDude.x = Game.canvasWidth - (8 * (i + 1));
        extraDude.y = 32;
        extraDude.configureTransform();
        extraDude.draw();
        context.restore();
      }
  
      if (showFramerate) {
        Text.renderText(''+avgFramerate, 24, Game.canvasWidth - 38, Game.canvasHeight - 2);
      }
  
      frameCount++;
      elapsedCounter += elapsed;
      if (elapsedCounter > 1000) {
        elapsedCounter -= 1000;
        avgFramerate = frameCount;
        frameCount = 0;
      }
  
      if (paused) {
        Text.renderText('PAUSED', 72, Game.canvasWidth/2 - 160, 120);
      } else {
        requestAnimFrame(mainLoop, canvasNode);
      }
    };
  
    mainLoop();
  
    $(window).keydown(function (e) {
      switch (KEY_CODES[e.keyCode]) {
        case 'f': // show framerate
          showFramerate = !showFramerate;
          break;
        case 'p': // pause
          paused = !paused;
          if (!paused) {
            // start up again
            lastFrame = Date.now();
            mainLoop();
          }
          break;
        case 'm': // mute
          SFX.muted = !SFX.muted;
          break;
      }
    });
  });
  
  // vim: fdl=0
  
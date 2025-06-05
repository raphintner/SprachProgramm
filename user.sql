CREATE Database linguaflow_db;
use linguaflow_db;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE vocab (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  word VARCHAR(100) NOT NULL,
  translation VARCHAR(100) NOT NULL,
  language VARCHAR(100) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE progress (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  vocab_id INT NOT NULL,
  next_review DATETIME,
  repetitions INT DEFAULT 0,
  easiness_factor FLOAT DEFAULT 2.5,
  last_result BOOLEAN,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (vocab_id) REFERENCES vocab(id) ON DELETE CASCADE
);

select * from users;

INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'apple', 'Apfel', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'book', 'Buch', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'car', 'Auto', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'dog', 'Hund', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'elephant', 'Elefant', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'flower', 'Blume', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'garden', 'Garten', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'house', 'Haus', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'ice', 'Eis', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'juice', 'Saft', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'key', 'Schlüssel', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'lamp', 'Lampe', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'mother', 'Mutter', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'night', 'Nacht', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'orange', 'Orange', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'pencil', 'Bleistift', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'queen', 'Königin', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'river', 'Fluss', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'sun', 'Sonne', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'tree', 'Baum', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'umbrella', 'Regenschirm', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'village', 'Dorf', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'window', 'Fenster', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'yellow', 'Gelb', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'zebra', 'Zebra', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'bread', 'Brot', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'cat', 'Katze', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'door', 'Tür', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'egg', 'Ei', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'fish', 'Fisch', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'goat', 'Ziege', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'hat', 'Hut', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'island', 'Insel', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'jacket', 'Jacke', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'king', 'König', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'lion', 'Löwe', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'milk', 'Milch', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'nose', 'Nase', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'owl', 'Eule', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'pen', 'Kugelschreiber', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'queen', 'Königin', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'rose', 'Rose', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'star', 'Stern', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'table', 'Tisch', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'uncle', 'Onkel', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'vase', 'Vase', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'water', 'Wasser', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'xylophone', 'Xylophon', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'yogurt', 'Joghurt', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'zero', 'Null', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'ant', 'Ameise', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'ball', 'Ball', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'cloud', 'Wolke', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'duck', 'Ente', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'ear', 'Ohr', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'frog', 'Frosch', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'grape', 'Traube', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'hill', 'Hügel', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'ink', 'Tinte', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'jeans', 'Jeans', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'kite', 'Drachen', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'leaf', 'Blatt', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'moon', 'Mond', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'nest', 'Nest', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'octopus', 'Oktopus', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'pig', 'Schwein', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'quilt', 'Steppdecke', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'rabbit', 'Kaninchen', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'snake', 'Schlange', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'train', 'Zug', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'umbrella', 'Regenschirm', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'violin', 'Geige', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'wolf', 'Wolf', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'x-ray', 'Röntgenbild', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'yawn', 'Gähnen', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'zoo', 'Zoo', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'baby', 'Baby', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'chair', 'Stuhl', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'desk', 'Schreibtisch', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'earring', 'Ohrring', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'fork', 'Gabel', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'glove', 'Handschuh', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'hammer', 'Hammer', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'iron', 'Bügeleisen', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'jungle', 'Dschungel', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'kangaroo', 'Känguru', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'ladder', 'Leiter', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'mirror', 'Spiegel', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'needle', 'Nadel', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'oven', 'Ofen', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'pillow', 'Kissen', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'quill', 'Feder', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'rope', 'Seil', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'spoon', 'Löffel', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'tooth', 'Zahn', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'uniform', 'Uniform', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'vulture', 'Geier', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'wheel', 'Rad', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'yacht', 'Yacht', 'English-German');
INSERT INTO vocab (user_id, word, translation, language) VALUES (1, 'zipper', 'Reißverschluss', 'English-German');

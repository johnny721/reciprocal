DROP TABLE IF EXISTS UserFavoriteTable;
DROP TABLE IF EXISTS RatingInfoTable;
DROP TABLE IF EXISTS CommentInfoTable;
DROP TABLE IF EXISTS RecipeInfoTable;
DROP TABLE IF EXISTS UserRecordTable;

CREATE TABLE UserRecordTable (
	userId INT NOT NULL AUTO_INCREMENT,
	username VARCHAR(50) NOT NULL,
	password VARCHAR(50) NOT NULL,
	email VARCHAR(50) NOT NULL,
	PRIMARY KEY (userId),
	UNIQUE KEY username (username),
	UNIQUE KEY email (email)
);

CREATE TABLE RecipeInfoTable (
	recipeId INT NOT NULL AUTO_INCREMENT,
	userId INT NOT NULL,
	recipeName VARCHAR(100) NOT NULL,
	description VARCHAR(500) NOT NULL,
	ingredients VARCHAR(1000) NOT NULL,
	preparation VARCHAR(5000) NOT NULL,
	timeReq INT NOT NULL,
	imageLink VARCHAR(200),
	submissionTS TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	PRIMARY KEY (recipeId),
	FOREIGN KEY (userId) REFERENCES UserRecordTable(userId)
);

CREATE TABLE CommentInfoTable (
	commentId INT NOT NULL AUTO_INCREMENT,
	userId INT NOT NULL,
	recipeId INT NOT NULL,
	commentText VARCHAR(1500),
	PRIMARY KEY (commentId),
	FOREIGN KEY (userId) REFERENCES UserRecordTable(userId),
	FOREIGN KEY (recipeId) REFERENCES RecipeInfoTable(recipeId)
);

CREATE TABLE RatingInfoTable (
	userId INT NOT NULL,
	recipeId INT NOT NULL,
	rating INT NOT NULL,
	PRIMARY KEY (userId, recipeId),
	FOREIGN KEY (userId) REFERENCES UserRecordTable(userId),
	FOREIGN KEY (recipeId) REFERENCES RecipeInfoTable(recipeId)
);

CREATE TABLE UserFavoriteTable (
	userId INT NOT NULL,
	recipeId INT NOT NULL,
	PRIMARY KEY (userId, recipeId),
	FOREIGN KEY (userId) REFERENCES UserRecordTable(userId),
	FOREIGN KEY (recipeId) REFERENCES RecipeInfoTable(recipeId)
);
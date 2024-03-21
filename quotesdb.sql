CREATE DATABASE quotesdb;

USE quotesdb;

CREATE TABLE authors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    author VARCHAR(255) NOT NULL
);

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(255) NOT NULL
);

CREATE TABLE quotes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    quote TEXT NOT NULL,
    author_id INT NOT NULL,
    category_id INT NOT NULL,
    FOREIGN KEY (author_id) REFERENCES authors(id),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

INSERT INTO authors (author) VALUES ('Mark Twain');
INSERT INTO authors (author) VALUES ('Oscar Wilde');
INSERT INTO authors (author) VALUES ('Albert Einstein');
INSERT INTO authors (author) VALUES ('Maya Angelou');
INSERT INTO authors (author) VALUES ('Confucius');

INSERT INTO categories (category) VALUES ('Inspiration');
INSERT INTO categories (category) VALUES ('Life');
INSERT INTO categories (category) VALUES ('Humor');
INSERT INTO categories (category) VALUES ('Wisdom');
INSERT INTO categories (category) VALUES ('Love');


INSERT INTO quotes (quote, author_id, category_id) VALUES ('The secret of getting ahead is getting started.', 1, 1);
INSERT INTO quotes (quote, author_id, category_id) VALUES ('What you do makes a difference, and you have to decide what kind of difference you want to make.', 4, 1);
INSERT INTO quotes (quote, author_id, category_id) VALUES ('Strive not to be a success, but rather to be of value.', 3, 1);
INSERT INTO quotes (quote, author_id, category_id) VALUES ('It does not matter how slowly you go as long as you do not stop.', 5, 1);
INSERT INTO quotes (quote, author_id, category_id) VALUES ('We must let go of the life we have planned, so as to accept the one that is waiting for us.', 4, 1);
INSERT INTO quotes (quote, author_id, category_id) VALUES ('Life is what happens when you’re busy making other plans.', 1, 2);
INSERT INTO quotes (quote, author_id, category_id) VALUES ('To live is the rarest thing in the world. Most people exist, that is all.', 2, 2);
INSERT INTO quotes (quote, author_id, category_id) VALUES ('Life is either a daring adventure or nothing at all.', 4, 2);
INSERT INTO quotes (quote, author_id, category_id) VALUES ('In the end, it’s not the years in your life that count. It’s the life in your years.', 1, 2);
INSERT INTO quotes (quote, author_id, category_id) VALUES ('Life is really simple, but we insist on making it complicated.', 5, 2);
INSERT INTO quotes (quote, author_id, category_id) VALUES ('Always borrow money from a pessimist. He won’t expect it back.', 1, 3);
INSERT INTO quotes (quote, author_id, category_id) VALUES ('I am so clever that sometimes I don’t understand a single word of what I am saying.', 2, 3);
INSERT INTO quotes (quote, author_id, category_id) VALUES ('The difference between stupidity and genius is that genius has its limits.', 3, 3);
INSERT INTO quotes (quote, author_id, category_id) VALUES ('If you want your children to listen, try talking softly to someone else.', 2, 3);
INSERT INTO quotes (quote, author_id, category_id) VALUES ('I didn’t fail the test. I just found 100 ways to do it wrong.', 1, 3);
INSERT INTO quotes (quote, author_id, category_id) VALUES ('It is not in the stars to hold our destiny but in ourselves.', 2, 4);
INSERT INTO quotes (quote, author_id, category_id) VALUES ('The only true wisdom is in knowing you know nothing.', 5, 4);
INSERT INTO quotes (quote, author_id, category_id) VALUES ('Education is the most powerful weapon which you can use to change the world.', 4, 4);
INSERT INTO quotes (quote, author_id, category_id) VALUES ('The only source of knowledge is experience.', 3, 4);
INSERT INTO quotes (quote, author_id, category_id) VALUES ('Wise men speak because they have something to say; fools because they have to say something.', 5, 4);
INSERT INTO quotes (quote, author_id, category_id) VALUES ('We love because it’s the only true adventure.', 4, 5);
INSERT INTO quotes (quote, author_id, category_id) VALUES ('Life without love is like a tree without blossoms or fruit.', 5, 5);
INSERT INTO quotes (quote, author_id, category_id) VALUES ('The best and most beautiful things in the world cannot be seen or even touched - they must be felt with the heart.', 4, 5);
INSERT INTO quotes (quote, author_id, category_id) VALUES ('Love does not consist in gazing at each other, but in looking outward together in the same direction.', 3, 5);
INSERT INTO quotes (quote, author_id, category_id) VALUES ('To love and be loved is to feel the sun from both sides.', 4, 5);


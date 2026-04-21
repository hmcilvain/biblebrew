CREATE TABLE events (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    uid VARCHAR(64),
    type VARCHAR(32),
    path VARCHAR(255),
    referrer TEXT,
    ip VARCHAR(45),
    created_at DATETIME
);


CREATE TABLE page_views (
    id INT AUTO_INCREMENT PRIMARY KEY,
    visitor_id VARCHAR(64),
    path VARCHAR(255),
    referrer TEXT,
    ip_address VARCHAR(45),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE subscribers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE,
    ip_address VARCHAR(45),
	first_name VARCHAR(100),
	last_name VARCHAR(100),
	address VARCHAR(255),
	city VARCHAR(100),
	state VARCHAR(50),
	zip_code VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE downloads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    file VARCHAR(255),
    visitor_id VARCHAR(64),
    ip_address VARCHAR(45),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

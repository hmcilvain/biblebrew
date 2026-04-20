CREATE TABLE events (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    uid VARCHAR(64),
    type VARCHAR(32),
    path VARCHAR(255),
    referrer TEXT,
    ip VARCHAR(45),
    created_at DATETIME
);

CREATE TABLE downloads (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    uid VARCHAR(64),
    file_key VARCHAR(64),
    ip VARCHAR(45),
    created_at DATETIME
);

CREATE TABLE subscribers (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE,
    uid VARCHAR(64),
    ip VARCHAR(45),
    created_at DATETIME
);

CREATE TABLE IF NOT EXISTS memos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    summary TEXT,
    memo TEXT,
    created_at DATE
) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

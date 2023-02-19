-- Jos taulukot olemassa niin ei suoriteta luontia
DROP TABLE IF EXISTS tasks, projects;

-- Luodaan taulukot projects ja tasks
CREATE TABLE projects (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL UNIQUE,
    category VARCHAR(100) NOT NULL
);

CREATE TABLE tasks (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL UNIQUE,
    date_task DATE NOT NULL,
    time_task INT(3) NOT NULL,
    project_id INT(11) NOT NULL,
    image_name VARCHAR(100),
    CONSTRAINT fk_tas_pro
        FOREIGN KEY (project_id)
        REFERENCES projects(id)
        ON DELETE CASCADE
)

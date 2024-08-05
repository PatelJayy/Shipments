CREATE TABLE employees (
    id INT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    age INT NOT NULL,
    role VARCHAR(50) NOT NULL,
    hireDate DATE NOT NULL,
    isActive BOOLEAN NOT NULL,
    salary DECIMAL(10, 2) NOT NULL,
    department VARCHAR(50) NOT NULL,
    projectsCompleted INT NOT NULL,
    lastLogin DATETIME NOT NULL,
    accessLevel VARCHAR(50) NOT NULL
);


INSERT INTO employees (id, name, age, role, hireDate, isActive, salary, department, projectsCompleted, lastLogin, accessLevel) VALUES
(1, 'Alice Johnson', 28, 'Engineer', '2022-01-15', TRUE, 85000, 'Development', 5, '2024-07-28 14:48:00', 'Admin'),
(2, 'Bob Smith', 34, 'Manager', '2020-06-30', FALSE, 95000, 'Operations', 10, '2024-07-30 09:21:00', 'User'),
(3, 'Charlie Rose', 22, 'Intern', '2023-03-01', TRUE, 45000, 'Development', 1, '2024-07-29 17:03:00', 'User'),
(4, 'David Green', 40, 'Director', '2018-11-20', TRUE, 120000, 'Management', 20, '2024-07-27 12:35:00', 'Admin'),
(5, 'Eva White', 30, 'Designer', '2021-05-15', TRUE, 70000, 'Design', 8, '2024-07-31 10:15:00', 'User'),
(6, 'Frank Black', 29, 'Engineer', '2019-09-17', TRUE, 80000, 'Development', 6, '2024-07-25 11:45:00', 'User'),
(7, 'Grace Brown', 26, 'Engineer', '2021-04-10', FALSE, 78000, 'Development', 4, '2024-07-20 09:00:00', 'User'),
(8, 'Hank Green', 45, 'Senior Manager', '2017-03-25', TRUE, 110000, 'Operations', 15, '2024-07-29 13:22:00', 'Admin'),
(9, 'Ivy Blue', 31, 'Designer', '2019-08-05', TRUE, 72000, 'Design', 7, '2024-07-28 08:48:00', 'User'),
(10, 'Jack White', 37, 'Product Manager', '2020-02-20', FALSE, 95000, 'Product', 12, '2024-07-26 15:18:00', 'Admin'),
(11, 'Kara Black', 33, 'Engineer', '2018-12-12', TRUE, 85000, 'Development', 9, '2024-07-29 12:00:00', 'User'),
(12, 'Leo Green', 27, 'Designer', '2021-01-30', TRUE, 68000, 'Design', 3, '2024-07-28 16:15:00', 'User'),
(13, 'Mona Blue', 36, 'Engineer', '2019-11-18', TRUE, 87000, 'Development', 11, '2024-07-30 14:50:00', 'User'),
(14, 'Nina Brown', 25, 'Intern', '2023-04-14', TRUE, 42000, 'Development', 2, '2024-07-31 11:00:00', 'User'),
(15, 'Oscar White', 42, 'Director', '2016-05-11', TRUE, 125000, 'Management', 22, '2024-07-29 09:33:00', 'Admin');

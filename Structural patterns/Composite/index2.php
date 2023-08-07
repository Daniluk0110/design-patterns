<?php

// Общий интерфейс для всех компонентов (департаментов)
interface Department
{
    public function getName(): string;

    public function getEmployeesCount(): int;
}

// Листовой компонент (отдел)
class DepartmentLeaf implements Department
{
    private string $name;
    private int $employeesCount;

    public function __construct(string $name, int $employeesCount)
    {
        $this->name = $name;
        $this->employeesCount = $employeesCount;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmployeesCount(): int
    {
        return $this->employeesCount;
    }
}

// Композит (группа департаментов)
class DepartmentComposite implements Department
{
    private string $name;
    private array $departments = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addDepartment(Department $department): void
    {
        $this->departments[] = $department;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmployeesCount(): int
    {
        $totalEmployees = 0;

        foreach ($this->departments as $department) {
            $totalEmployees += $department->getEmployeesCount();
        }

        return $totalEmployees;
    }
}

// Пример использования
$hrDepartment = new DepartmentLeaf("HR", 10);
$itDepartment = new DepartmentLeaf("IT", 15);
$financeDepartment = new DepartmentLeaf("Finance", 8);

$marketingDepartment = new DepartmentComposite("Marketing");
$marketingDepartment->addDepartment($hrDepartment);
$marketingDepartment->addDepartment($itDepartment);

$company = new DepartmentComposite("Company");
$company->addDepartment($marketingDepartment);
$company->addDepartment($financeDepartment);

echo $company->getName() . " has " . $company->getEmployeesCount() . " employees."; // Output: Company has 33 employees.

class Connection:
    _instance = None
    _name = ""

    def __new__(cls):
        if cls._instance is None:
            cls._instance = super(Connection, cls).__new__(cls)
            cls._instance._name = ""
        return cls._instance

    @classmethod
    def set_name(cls, name):
        cls._name = name

    @classmethod
    def get_name(cls):
        return cls._name

    def __init__(self):
        pass

    def __clone__(self):
        pass

    def __get_state__(self):
        return None

    def __setstate__(self, state):
        pass

# Пример использования
connection = Connection()
connection.set_name("connection1")

connection2 = Connection()
print(connection2.get_name())  # Вывод: connection1

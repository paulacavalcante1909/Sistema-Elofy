import { setData, getData, deleteData, editData } from "../Services/Requests";

import { useState, useEffect } from 'react';

export default function Home() {
    const [user, setUser] = useState({});

    const [editing, setEditing] = useState(null);

    const [listUsers, setListUsers] = useState([]);

    const handleChange = (event) => {
        const name = event.target.name;
        const value = event.target.value;
        setUser(values => ({ ...values, [name]: value }))
    }


    const handleChangeEdit = (event) => {
        const name = event.target.name;
        const value = event.target.value;
        setEditing(values => ({ ...values, [name]: value }))
    }

    function addUser() {
        setData(user).then((res) => {
            if (res.status === 200) {
                alert('Dado inserido com sucesso');
                getListUsers();
                setUser({})
            } else {
                alert('Oops, houve um erro');
            }
        });


    }

    function saveUser() {
        editData(editing).then((res) => {
            if (res.status === 200) {
                alert('Dado inserido com sucesso');
                cancelEdit();
                getListUsers();
            } else {
                alert('Oops, houve um erro');
            }
        });
    }



    function removeUser(id) {
        let text = "Tem certeza que deseja excluir este usuário?";
        if (window.confirm(text) === true) {

            deleteData(id).then((res) => {
                if (res.status === 200) {
                    alert(res.message);
                    getListUsers();
                } else {
                    alert('Oops, houve um erro');
                }
            })
        } else {
            text = "You canceled!";
        }
    }

    function getListUsers() {
        getData().then((res) => {
            if (res.status === 200) {
                setListUsers(res.data)
            } else {
                alert('Oops, houve um erro');
            }
        });
    }

    function showEditUser(user) {
        setEditing(user);
    }

    function testElofy() {

        let palavra = 'Arara';

        let palavra_splited = palavra.toLowerCase().split('');

        let count = palavra_splited.length - 1;

        let isPalindromo = true;

        palavra_splited.every(letra => {

            if (palavra_splited[count] !== letra) {
                isPalindromo = false;
                return;
            }
            count--;
        });
        console.log(isPalindromo);
    }

    function cancelEdit() {
        setEditing(null);
    }


    useEffect(() => {
        getListUsers();
        testElofy();
    }, []);

    return <div className="container mt-5">
        <div className="row align-items-center">
            {editing &&
                <>
                    <div className="col-8 mb-5" >
                        <label htmlFor="name" className="form-label">Editando {editing.name}</label>
                        <input value={editing.name || ''} onChange={handleChangeEdit} type="text" className="form-control" id="name" name="name" placeholder="Nome usuário" />
                    </div>

                    <div className="col-2 align-self-end mb-5" >
                        <div className="d-grid gap-2">
                            <button type="button" onClick={saveUser} className="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                    <div className="col-2 align-self-end mb-5" >
                        <div className="d-grid gap-2">
                            <button type="button" onClick={cancelEdit} className="btn btn-danger">Cancelar</button>
                        </div>
                    </div>
                </>
            }


            <div className="col-8">
                <label htmlFor="name" className="form-label">Novo usuário</label>
                <input value={user.name || ''} onChange={handleChange} type="text" className="form-control" id="name" name="name" placeholder="Nome usuário" />
            </div>

            <div className="col-4 align-self-end">
                <div className="d-grid gap-2">
                    <button type="button" onClick={addUser} className="btn btn-success">Adicionar</button>
                </div>
            </div>

            <div className="col-12 my-3">
                <ul className="list-group ">
                    {listUsers.map((user) => (
                        <li className="list-group-item d-flex justify-content-between align-items-start">{user.name}
                            <div>
                                <button onClick={() => removeUser(user.id)} type="button" class="btn btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                                &nbsp; &nbsp;
                                <button onClick={() => showEditUser(user)} type="button" class="btn btn-warning">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>
                            </div>
                        </li>
                    ))}
                </ul>
            </div>
        </div>
    </div>

}
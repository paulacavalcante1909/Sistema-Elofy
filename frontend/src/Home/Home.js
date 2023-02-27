import { setData, getData, deletData } from "../Services/Requests";

import { useState, useEffect } from 'react';

export default function Home(props) {
    const [user, setUser] = useState({});

    const [listUsers, setListUsers] = useState([]);

    const handleChange = (event) => {
        const name = event.target.name;
        const value = event.target.value;
        setUser(values => ({ ...values, [name]: value }))
    }

    function addUser() {
        setData(user).then((res) => {
            if (res.status === 200) {
                alert('Dado inserido com sucesso');
                getListUsers();
            } else {
                alert('Oops, houve um erro');
            }
        });


    }


    function removeUser(id) {
        let text = "Tem certeza que deseja excluir este usuário?";
        if (window.confirm(text) === true) {

            deletData(id).then((res) => {
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


    useEffect(() => {
        getListUsers();
    }, []);
    return <div className="container mt-5">
        <div className="row align-items-center">
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
                        <li className="list-group-item d-flex justify-content-between align-items-start">{user.name} <button onClick={() => removeUser(user.id)} type="button" class="btn btn-danger">
                            <i class="bi bi-trash"></i>
                        </button></li>
                    ))}
                </ul>

            </div>
        </div>
    </div>

}
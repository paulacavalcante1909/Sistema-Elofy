import axios from 'axios';

const url = 'http://localhost:8080/';


// useEffect(() => {
//     getCharacters().then((res) => setResponse(res.results));
//   }, []);

export const getData = async () => {
	try {
		const res = await axios.get(`${url}user/list`, {
			headers: {},
			params: {}
		});
		return res.data;
	} catch (err) {
		console.log(err);
	}
};


export const setData = async (data) => {
	try {
		var form = new FormData();

		form.append('name', data.name);
		console.log(data);
		const res = await axios.post(`${url}user/add`, form);

		return res.data;
	} catch (err) {
		console.log(err);
	}
};



export const deleteData = async (id) => {
	try {

		var form = new FormData();

		form.append('id', id);

		const res = await axios.post(`${url}user/delete`, form);

		return res.data;

	} catch (err) {
		console.log(err);
	}
};
import axios from 'axios';

const url = '';


// useEffect(() => {
//     getCharacters().then((res) => setResponse(res.results));
//   }, []);

export const getData = async () => {
	try {
		const res = await axios.get(`${url}/character`, {
			headers: {},
			params: {}
		});
        return res.data;
	} catch (err) {
		console.log(err);
	}
};

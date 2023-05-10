const instance = axios.create({
    baseURL: 'http://testedigitaliza.gui/api/',
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    },
    withCredentials: true
})

// Definir um interceptor para incluir o token de autenticação em todas as requisições
instance.interceptors.request.use(function (config) {
    const token = localStorage.getItem('token');
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
});

/**
 * Axios get
 * 
 * @param {string} url
 * @param {object} params
 * @returns {Promise}
 * 
 */

async function get (url, params) {
    return await new Promise((resolve, reject) => {
        instance.get(url, params)
        .then(response => {
            resolve(response);
        })
        .catch(error => {
            reject(error);
        });
    });
}

/**
 * Axios post
 * 
 * @param {string} url
 * @param {object} params
 * @returns {Promise}
 */

async function post (url, params) {

    console.log(url,params);
    return await new Promise((resolve, reject) => {
        instance.post(url, params)
        .then(response => {
            resolve(response);
        })
        .catch(error => {
            reject(error);
        })
    });
}

/**
 * Axios put
 * 
 * @param {string} url
 * @param {object} params
 * @returns {Promise}
 */

async function put (url, params) {
    return await new Promise((resolve, reject) => {
        instance.put(url, params)
        .then(response => {
            resolve(response);
        })
        .catch(error => {
            reject(error);
        });
    });
}

/**
 * Axios delete
 * 
 * @param {string} url
 * @param {object} params
 * @returns {Promise}
 */

async function del (url, params) {
    return await new Promise((resolve, reject) => {
        instance.delete(url, params)
        .then(response => {
            resolve(response);
        })
        .catch(error => {
            reject(error);
        });
    });
}


export default { get, post, put, del }
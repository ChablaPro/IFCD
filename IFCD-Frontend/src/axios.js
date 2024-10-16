import axios from "axios";

const axiosInstance = axios.create({
    baseURL:'https://api.queenbloh.com/api'
})

export default axiosInstance
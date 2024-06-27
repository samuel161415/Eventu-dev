import { useToast } from 'vue-toastification';

const toast = useToast();

export default {
  success(message) {
    toast.success(message);
  },
  error(message) {
    toast.error(message);
  },
  info(message) {
    toast.info(message);
  },
  warning(message) {
    toast.warning(message);
  },
};

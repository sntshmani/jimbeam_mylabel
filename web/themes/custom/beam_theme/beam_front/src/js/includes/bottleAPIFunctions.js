import axios from "axios";

async function checkBlackList(label, prohibitedUrl) {
  const response = await axios.get(prohibitedUrl, {
    params: {
      label: label,
    },
  });

  return response.data.result;
}

async function getImageLabel(bottle, labelUrl) {
  const response = await axios.get(labelUrl, {
    params: {
      bottle: bottle,
    },
  });
  return response.data.result;
}


export { getImageLabel, checkBlackList };

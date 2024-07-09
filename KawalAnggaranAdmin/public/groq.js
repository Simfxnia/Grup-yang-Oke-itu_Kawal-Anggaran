import Groq from 'groq-sdk';
import dotenv from 'dotenv';

// Load environment variables from .env file
dotenv.config();

// Initialize the Groq SDK with your API key
const groq = new Groq({ apiKey: process.env.GROQ_API_KEY });

// Main function to execute the Groq query
export async function main() {
    try {
        const chatCompletion = await getGroqChatCompletion();
        // Print the completion returned by the LLM.
        console.log(chatCompletion.choices[0]?.message?.content || "");
    } catch (error) {
        console.error('Error fetching Groq chat completion:', error);
    }
}

// Function to fetch Groq chat completion
export async function getGroqChatCompletion() {
    try {
        return await groq.chat.completions.create({
            messages: [
                {
                    role: "user",
                    content: "Explain the importance of fast language models",
                },
            ],
            model: "llama3-8b-8192",
        });
    } catch (error) {
        console.error('Error creating Groq chat completion:', error);
        throw error; // Optionally re-throw or handle gracefully as needed
    }
}

// Optionally, call your main function
main();

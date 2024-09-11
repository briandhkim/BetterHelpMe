const RadioQuestion = ({ question, data, setData }) => {
	const { choices } = question;
	return (
		<div className=' space-y-10'>
			<fieldset>
				<legend className='text-sm font-semibold leading-6 text-gray-900'>
					{question.title}
				</legend>
				<div className='mt-6 space-y-6'>
					{choices.map(choice => (
						<div
							key={choice.id}
							className='flex items-center gap-x-3'
						>
							<input
								id={`question-${question.id}-choice-${choice.id}`}
								name={`question-${question.id}`}
								type='radio'
								className='h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600'
								value={choice.value}
								onChange={e =>
									setData(prevData => ({
										...prevData,
										[`question_${question.id}`]: [
											choice.label,
										],
									}))
								}
							/>
							<label
								htmlFor={`question-${question.id}-choice-${choice.id}`}
								className='block text-sm font-medium leading-6 text-gray-900'
							>
								{choice.label}
							</label>
						</div>
					))}
				</div>
			</fieldset>
		</div>
	);
};

export default RadioQuestion;
